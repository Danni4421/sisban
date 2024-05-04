<?php

namespace App\Traits;

use App\Models\Pengajuan;

trait ManagePengajuan
{
    /**
     * @param string $no_kk
     *
     * @return void
     */
    public function updatePengajuanToApproved($no_kk)
    {
        Pengajuan::find($no_kk)
            ->whereNotIn('status_pengajuan', ['diterima', 'ditolak'])
            ->update(['status_pengajuan' => 'diterima']);
    }

    /**
     * @param string $no_kk
     *
     * @return void
     */
    public function updatePengajuanToDeclined($no_kk)
    {
        Pengajuan::find($no_kk)
            ->whereNotIn('status_pengajuan', ['diterima', 'ditolak'])
            ->update(['status_pengajuan' => 'ditolak']);
    }

    public function getDataPengajuan()
    {
        return Pengajuan::with(['keluarga' => function ($query) {
            $query->with(['anggota_keluarga' => function ($query) {
                $query->where('level', 'kepala_keluarga');
            }]);
        }])->get();
    }
}
