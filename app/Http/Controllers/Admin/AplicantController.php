<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\PemohonDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Traits\ManagePengajuan;

class AplicantController extends Controller
{
    use ManagePengajuan;

    public ?PemohonDataTable $dataTable;

    public function __construct()
    {
        $this->dataTable = app()->make(PemohonDataTable::class);
    }

    public function index()
    {
        return $this->dataTable->render("admin.pages.aplicant.index");
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
