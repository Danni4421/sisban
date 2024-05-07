<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use App\Models\PenerimaBansos;
use App\Models\Pengajuan;
use App\Traits\ManagePengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Dompdf\Options;

class PengajuanController extends Controller
{
    use ManagePengajuan;
    public function approved()
    {
        $dataPengajuan = $this->getDataPengajuan();
        return view('rw.pages.pengajuan.approved_data')->with('dataPengajuan', $dataPengajuan);
    }

    public function show(string $no_kk)
    {
        return Pengajuan::with(['keluarga' => function ($query) {
            $query->with('anggota_keluarga');
        }])
        ->where('no_kk', $no_kk)
        ->first();
    }

    public function cetakPDF($no_kk)
    {
        // Ambil data pengajuan berdasarkan nomor KK
        $pengajuan = Pengajuan::where('no_kk', $no_kk)->first();
    
        // Load view 'pdf' dengan data pengajuan
        $pdf = new Dompdf();
        $pdf->loadHtml(view('rw.pages.pengajuan.pdf', compact('pengajuan')));
    
        // Render PDF
        $pdf->render();
    
        // Mengatur nama file
        $filename = 'dokumen_' . $no_kk . '.pdf';
    
        // Mengembalikan respons dengan file PDF yang diunduh
        return $pdf->stream($filename);
    }    

    public function main()
    {
        $data = DB::table("pengurus")->get();
        return view('rw.pages.rt.member', ['data' => $data]);
    }

    public function tambah()
    {
        return view('rw.pages.rt.member_tambah');
    }

    public function tambah_simpan(Request $request)
    {
        PenerimaBansos::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat
        ]);

        return redirect('data-rt');
    }

    public function ubah($id)
    {
        $rt = PenerimaBansos::find($id);
        return view('rw.pages.rt.member_ubah', ['data' => $rt]);
    }

    public function ubah_simpan($id, Request $request)
    {
        $rt = PenerimaBansos::find($id);

        $rt->nama = $request->nama;
        $rt->jabatan = $request->jabatan;
        $rt->nomor_telepon = $request->nomor_telepon;
        $rt->alamat = $request->alamat;

        $rt->save();

        return redirect('data-rt');
    }

    public function hapus($id)
    {
        $rt = PenerimaBansos::find($id);
        $rt->delete();

        return redirect('data-rt');
    }

}
