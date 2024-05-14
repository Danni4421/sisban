<?php

namespace App\Http\Controllers\RT;

use App\DataTables\RT\Pengajuan\ApprovedDataDataTable;
use App\DataTables\RT\Pengajuan\IncomingDataDataTable;
use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Traits\ManagePengajuan;
use Illuminate\Http\Request;

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
            $query->with('anggota_keluarga');
        }])
        ->where('no_kk', $no_kk)
        ->first();
    }

    public function approvePengajuan($no_kk)
    {
        $this->updatePengajuanToApproved($no_kk);
    }

    public function declinePengajuan($no_kk)
    {
        $this->updatePengajuanToDeclined($no_kk);
    }
}
