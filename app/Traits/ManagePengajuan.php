<?php

namespace App\Traits;

use App\Models\Keluarga;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\DB;

trait ManagePengajuan
{
    /**
     * @param string $no_kk
     *
     * @return void
     */
    public function updatePengajuanToApproved($no_kk)
    {
        Pengajuan::whereNotIn('status_pengajuan', ['diterima', 'ditolak'])
            ->where('no_kk', $no_kk)
            ->first()
            ->update(['status_pengajuan' => 'diterima']);

        Keluarga::where('no_kk', $no_kk)
            ->update([
                'is_kandidat' => 1,
            ]);
    }

    /**
     * @param string $no_kk
     *
     * @return void
     */
    public function updatePengajuanToDeclined($no_kk, $message)
    {
        Pengajuan::whereNotIn('status_pengajuan', ['diterima', 'ditolak'])
            ->where('no_kk', $no_kk)
            ->first()
            ->update([
                'status_pengajuan' => 'ditolak',
                'message' => $message
            ]);
    }

    public function getDataPengajuan()
    {
        return Pengajuan::with(['keluarga' => function ($query) {
            $query->with('kepala_keluarga', 'anggota_keluarga');

            $query
                ->leftJoin('hutang', 'hutang.no_kk', '=', 'keluarga.no_kk')
                ->select('keluarga.no_kk', DB::raw('SUM(hutang.jumlah) as jumlah_hutang'))
                ->groupBy('keluarga.no_kk');
        }])
            ->get();
    }
}
