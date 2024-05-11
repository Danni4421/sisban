<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $user = User::with('pengurus')
            ->where('id_user', auth()->user()->id_user)
            ->first();
        
        return view('generals.account.index')->with('user', $user);
    }

    public function update(Request $request, int $id)
    {
        $pengurus = Pengurus::find($id);

        $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'nomor_telepon' => ['required', 'max:13', 'unique:pengurus,nomor_telepon,' . $id . ',id_pengurus'],
            'alamat' => ['required', 'string', 'max:100']
        ]);
    
        $pengurus->update([
            'nama' => $request->nama,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect('akun/informasi');
    }
}