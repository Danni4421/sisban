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
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;

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
        /**
         * Verify alternative should not exists
         */
        $alternative = Alternative::where(['id_bansos' => $id_bansos, 'no_kk' => $no_kk])->first();

        /**
         * If alternative has been already exists then return response success == 'false'
         */
        if ($alternative) {
            return response()->json(['success' => false]);
        }

        /**
         * Create new model for new alternative
         */
        $new_alternative = Alternative::make([
            'id_bansos' => $id_bansos,
            'no_kk' => $no_kk,
            'is_qualified' => 1
        ]);

        /**
         * Retrieves the previous alternative and push new alternative
         */
        $alternatives = Alternative::where('id_bansos', $id_bansos)->with('kandidat.kepala_keluarga')->get();
        $alternatives->push($new_alternative);

        $bansos = Bansos::find($id_bansos);

        /**
         * If the alternative is less than equal jumlah bansos, Then save the alternative
         * Else return to calculate the alternative
         */
        if (count($alternatives) <= $bansos->jumlah) {
            $new_alternative->save();
            return response()->json(['success' => true]);
        }

        /**
         * Assign alternative data
         */
        $data = $this->get_alternative_data($alternatives);

        /**
         * Request to calculate decission system
         */
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

    public function delete_alternative(int $id_bansos, string $no_kk)
    {
        /**
         * Delete alternatif
         */
        Alternative::find(['id_bansos' => $id_bansos, 'no_kk' => $no_kk])->delete();

        $bansos = Bansos::where('id_bansos', $id_bansos);
        $new_alternatives = Alternative::where('id_bansos', $id_bansos)->get();

        $data = $this->get_alternative_data($new_alternatives);
        $data['bansos'] = $id_bansos;

        /**
         * Request to calculate decission system
         */
        $response = Http::post(
            url: env('DSS_URL') . 'calculate',
            data: $data,
        );

        $response = json_decode($response);

        if ($response->status_code == 200) {
            /**
             * Update is qualified bansos
             */
            foreach ($response->data as $key => $res) {
                $new_alternatives[$key]->update([
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
         * Return response if success
         */
        return response()->json([
            'success' => false
        ]);
    }

    private function get_alternative_data(Collection $alternatives)
    {
        return $alternatives->map(function ($alternative) {
            $no_kk = $alternative->no_kk;
            return [
                'alternatif' => $no_kk,
                'kepala_keluarga' => $alternative->kandidat->kepala_keluarga->nama,
                'penghasilan' => Warga::where('no_kk', $alternative->no_kk)->sum('penghasilan'),
                'pengeluaran' => $alternative->kandidat->pengeluaran,
                'tanggungan' => Warga::where('no_kk', $alternative->no_kk)->whereIn('status', ['tidak_bekerja', 'sekolah'])->count(),
                'hutang' => Hutang::where('no_kk', $alternative->no_kk)->sum('jumlah'),
                'aset' => Aset::where('no_kk', $alternative->no_kk)->sum('harga_jual'),
                'biaya_listrik' => $alternative->kandidat->biaya_listrik,
                'biaya_air' => $alternative->kandidat->biaya_air
            ];
        })->toArray();
    }

    public function perhitunganFuzzy(string $no_kk)
    {
        return view('rt.pages.bansos.alternative.perhitunganFuzzy');
    }
}
