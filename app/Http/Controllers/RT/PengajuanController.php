<?php

namespace App\Http\Controllers\RT;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Traits\ManagePengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    use ManagePengajuan;
    public function incoming()
    {
        $dataPengajuan = $this->getDataPengajuan();
        return view('rt.pages.pengajuan.incoming_data')->with('dataPengajuan', $dataPengajuan);
    }

    public function approved()
    {
        $dataPengajuan = $this->getDataPengajuan();
        return view('rt.pages.pengajuan.approved_data')->with('dataPengajuan', $dataPengajuan);
    }

    public function show(string $no_kk)
    {
        return $no_kk;
        return Pengajuan::with(['keluarga' => function ($query) {
            $query->with('anggota_keluarga');
        }])
        ->where('no_kk', $no_kk)
        ->first();
    }

    public function approvePengajuan($no_kk)
    {
        try {
            $this->updatePengajuanToApproved($no_kk);
            return redirect('/rt/pengajuan/masuk')->with('success', 'Pengajuan telah disetujui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyetujui pengajuan: ' . $e->getMessage());
        }
    }

    public function declinePengajuan($no_kk)
    {
        try {
            $this->updatePengajuanToDeclined($no_kk);
            return redirect('/rt/pengajuan/masuk')->with('success', 'Pengajuan telah ditolak.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menolak pengajuan: ' . $e->getMessage());
        }
    }
}
