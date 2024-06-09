<?php

namespace App\Http\Controllers\RT;

use App\DataTables\RT\Pengajuan\ApprovedDataDataTable;
use App\DataTables\RT\Pengajuan\IncomingDataDataTable;
use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Traits\ManagePengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PengajuanController extends Controller
{
    use ManagePengajuan;

    public ?IncomingDataDataTable $incomingDatatable;
    public ?ApprovedDataDataTable $approvedDatatable;

    public function __construct()
    {
        $this->incomingDatatable = app()->make(IncomingDataDataTable::class);
        $this->approvedDatatable = app()->make(ApprovedDataDataTable::class);
    }

    public function incoming()
    {
        return $this->incomingDatatable->render('rt.pages.pengajuan.incoming_data');
    }

    public function approved()
    {
        return $this->approvedDatatable->render('rt.pages.pengajuan.approved_data');
    }

    public function show(string $no_kk)
    {
        return Pengajuan::with(['keluarga' => function ($query) {
            $query->with('anggota_keluarga', 'kepala_keluarga')
                ->leftJoin('hutang', 'hutang.no_kk', '=', 'keluarga.no_kk')
                ->select(
                    'keluarga.foto_kk',
                    'keluarga.no_kk',
                    'daya_listrik',
                    'biaya_listrik',
                    'biaya_air',
                    'keluarga.pengeluaran',
                    DB::raw('SUM(hutang.jumlah) as jumlah_hutang')
                )
                ->groupBy('keluarga.no_kk');
        }])
            ->where('no_kk', $no_kk)
            ->first();
    }

    public function approvePengajuan($no_kk)
    {
        $this->updatePengajuanToApproved($no_kk);
    }

    public function declinePengajuan(Request $request, string $no_kk)
    {
        $validator = Validator::make(
            $request->all(), 
            [
                'message' => 'required|string'
            ], 
            [
                'required' => 'Perlu untuk memberikan pesan penolakan',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ]);
        }

        $this->updatePengajuanToDeclined($no_kk, $request->message);
    }
}
