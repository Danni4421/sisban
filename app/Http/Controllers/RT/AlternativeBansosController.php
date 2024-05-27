<?php

namespace App\Http\Controllers\RT;

use App\DataTables\RT\Bansos\AlternativeDataTable;
use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\Aset;
use App\Models\Bansos;
use App\Models\Hutang;
use App\Models\Keluarga;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AlternativeBansosController extends Controller
{
    public ?AlternativeDataTable $dataTable;

    public function __construct()
    {
        $this->dataTable = app()->make(AlternativeDataTable::class);
    }

    public function main(int $id_bansos)
    {
        $bansos = Bansos::find($id_bansos);

        if (!$bansos) {
            abort(404, 'Bansos not found');
        }

        return $this->dataTable
            ->with('id_bansos', $id_bansos)
            ->render('rt.pages.bansos.alternative.index', ['bansos' => $bansos]);
    }

    public function list_candidate($id_bansos)
    {
        $rt = substr(auth()->user()->pengurus->jabatan, 2);

        $kandidat = Keluarga::with(['kepala_keluarga' => function ($query) {
            $query->select('nama', 'nik', 'no_kk');
        }])
            ->select('no_kk')
            ->where('is_kandidat', 1)
            ->where('rt', $rt)
            ->whereNotIn('no_kk', Alternative::where('id_bansos', $id_bansos)->select('no_kk')->get())
            ->get();


        return $kandidat;
    }

    public function to_alternative(int $id_bansos, string $no_kk)
    {
        $alternative = Alternative::where(['id_bansos' => $id_bansos, 'no_kk' => $no_kk])
            ->first();

        if ($alternative) {
            return response()->json([
                'success' => false
            ]);
        }

        $new_alternative = Alternative::make([
            'id_bansos' => $id_bansos,
            'no_kk' => $no_kk,
            'is_qualified' => 1
        ]);

        $alternatives = Alternative::where('id_bansos', $id_bansos)
            ->with('kandidat.kepala_keluarga')
            ->get();

        $alternatives[] = $new_alternative;

        $bansos = Bansos::find($id_bansos);

        if (count($alternatives) <= $bansos->jumlah) {
            $new_alternative->save();

            return response()->json([
                'success' => true
            ]);
        }

        $data = [];

        foreach ($alternatives as $alternative) {
            $tanggungan = Warga::where('no_kk', $alternative->no_kk)
                ->whereIn('status', ['tidak_bekerja', 'sekolah'])
                ->count();

            $total_aset = Aset::where('no_kk', $alternative->no_kk)
                ->sum('harga_jual');

            $total_gaji = Warga::where('no_kk', $alternative->no_kk)
                ->sum('penghasilan');

            $total_hutang = Hutang::where('no_kk', $alternative->no_kk)
                ->sum('jumlah');

            $data[] = [
                "alternatif" => $alternative->no_kk,
                "kepala_keluarga" => $alternative->kandidat->kepala_keluarga->nama,
                "gaji" => $total_gaji,
                "pengeluaran" => $alternative->kandidat->pengeluaran,
                "tanggungan" => $tanggungan,
                "hutang" => $total_hutang,
                "aset" => $total_aset,
                "biaya_listrik" => $alternative->kandidat->biaya_listrik,
                "biaya_air" => $alternative->kandidat->biaya_air
            ];
        }

        $response = Http::post(
            url: env('DSS_URL') . 'calculate',
            data: $data,
        );

        $response = json_decode($response);

        if ($response->status_code == 200) {
            /**
             * Save new alternative
             */
            $new_alternative->save();

            /**
             * Update is qualified bansos
             */
            foreach ($response->data as $key => $res) {
                $alternatives[$key]->update([
                    'is_qualified' => $res->rank <= $bansos->jumlah,
                ]);
            }

            /**
             * Return response if success
             */
            return response()->json([
                'success' => true
            ]);
        }

        /**
         * Return response if fail
         */
        return response()->json([
            'success' => false
        ]);
    }
}
