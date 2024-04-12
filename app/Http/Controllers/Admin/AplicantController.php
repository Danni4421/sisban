<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Traits\ManagePengajuan;

class AplicantController extends Controller
{
    use ManagePengajuan;

    public function index()
    {
        $aplicants = Pengajuan::with(['keluarga' => function ($query) {
            $query->with(['anggota_keluarga' => function ($query) {
                $query->where('level', 'kepala_keluarga');
            }]);
        }])->get();

        return view('admin.pages.aplicant.index')
            ->with('aplicants', $aplicants);
    }

    public function show(string $no_kk)
    {
        return Pengajuan::with(['keluarga' => function ($query) {
            $query->with('anggota_keluarga');
        }])
        ->where('no_kk', $no_kk)
        ->first();
    }

    public function approve(string $no_kk)
    {
        $this->updatePengajuanToApproved(no_kk: $no_kk);
        return redirect('admin/pemohon');
    }

    public function decline(string $no_kk)
    {
        $this->updatePengajuanToDeclined(no_kk: $no_kk);
        return redirect('admin/pemohon');
    }
}
