<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\PemohonDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Traits\ManagePengajuan;
use Illuminate\Support\Facades\DB;

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
            $query->with('anggota_keluarga', 'kepala_keluarga')
                ->leftJoin('hutang', 'hutang.no_kk', '=', 'keluarga.no_kk')
                ->select(
                    'keluarga.foto_kk',
                    'keluarga.no_kk',
                    'daya_listrik',
                    'biaya_listrik',
                    'biaya_air',
                    'keluarga.pengeluaran',
                    DB::raw('SUM(hutang.jumlah) as hutang')
                )
                ->groupBy(
                    'keluarga.no_kk',
                    'keluarga.foto_kk',
                    'keluarga.daya_listrik',
                    'keluarga.biaya_listrik',
                    'keluarga.biaya_air',
                    'keluarga.pengeluaran'
                );
        }])
            ->where('no_kk', $no_kk)
            ->first();
    }

    public function approve(string $no_kk)
    {
        $this->updatePengajuanToApproved(no_kk: $no_kk);
    }

    public function decline(string $no_kk)
    {
        $this->updatePengajuanToDeclined(no_kk: $no_kk, message: "");
    }
}
