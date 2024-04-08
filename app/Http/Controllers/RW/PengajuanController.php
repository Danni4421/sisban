<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use App\Models\PenerimaBansos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengajuanController extends Controller
{
    public function incoming()
    {
        return view('rw.pages.pengajuan.incoming_data');
    }

    public function approved()
    {
        $data = DB::table('penerima_bansos');
        return view('rw.pages.pengajuan.approved_data');
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
