<?php

namespace App\Http\Controllers\RW;

use App\DataTables\RW\PemohonDataTable;
use App\Http\Controllers\Controller;
use App\Models\PenerimaBansos;
use App\Models\Pengajuan;
use App\Models\Pengurus;
use App\Traits\ManagePengajuan;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class PengajuanController extends Controller
{
    use ManagePengajuan;

    public ?PemohonDataTable $dataTable;

    public function __construct()
    {
        $this->dataTable = app()->make(PemohonDataTable::class);
    }

    public function approved()
    {
        return $this->dataTable->render('rw.pages.pengajuan.approved_data');
    }

    public function show(string $no_kk)
    {
        return Pengajuan::with('keluarga.kepala_keluarga', 'keluarga.anggota_keluarga')
        ->where('no_kk', $no_kk)
        ->first();
    }

    public function print_pdf($no_kk)
    {
        $pengajuan = Pengajuan::where('no_kk', $no_kk)->first();

        Pengajuan::where('no_kk', $no_kk)->update(['is_printed' => 1]);
    
        $pdf = new Dompdf();
        $pdf->loadHtml(view('rw.pages.pengajuan.pdf', compact('pengajuan')));
    
        $pdf->render();

        $filename = 'dokumen_' . $no_kk . '.pdf';
    
        return $pdf->stream($filename);
    }    
}
