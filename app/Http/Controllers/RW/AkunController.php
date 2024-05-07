<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use App\Models\User;
use App\Traits\ManageRW;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index()
    {
        $rw = Pengurus::select('id_pengurus', 'id_user', 'jabatan', 'nama', 'nomor_telepon', 'alamat')
          ->with('user')
          ->whereHas('user', function ($query) {
              $query->where('level', 'rw');
          })
          ->first();

        return view('rw.pages.akun.index')->with('rw', $rw);
    }

    public function update(Request $request, int $id)
    {
        $pengurus = Pengurus::find($id);

        $request->validate([
            'username' => ['required', 'string', 'min:4', 'max:50', 'unique:users,username,' . $pengurus->id_user . ',id_user'],
            'email' => ['required', 'email:dns', 'max:100', 'unique:users,email,' . $pengurus->id_user . ',id_user'],
            'jabatan' => ['required', 'string', 'max:11', 'unique:pengurus,jabatan,' . $id . ',id_pengurus'],
            'nama' => ['required', 'string', 'max:100'],
            'nomor_telepon' => ['required', 'max:13', 'unique:pengurus,nomor_telepon,' . $id . ',id_pengurus'],
            'alamat' => ['required', 'string', 'max:100']
        ]);
        
        User::find($pengurus->id_user)->update([
            'username' => $request->username,
            'email' => $request->email,
        ]);

        $pengurus->update([
            'jabatan' => $request->jabatan,
            'nama' => $request->nama,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect('rw/akun/informasi');
    }
}