<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function main()
    {
        $data = DB::table("pengurus")->get();
        return view('rw.pages.rt.member', ['data' => $data]);
    }

    public function create()
    {
        return view('rw.pages.rt.member_tambah');
    }

    public function store(Request $request)
    {
        $user = User::make([
            'username' => $request->username,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
            'level' => $request->level
        ]);

        $user->save();

        Pengurus::create([
            'id_user' => $user->id_user,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat
        ]);

        return redirect('rw/data-rt');
    }

    public function edit($id)
    {
        $rt = Pengurus::find($id);
        return view('rw.pages.rt.member_ubah', ['data' => $rt]);
    }

    public function update($id, Request $request)
    {
        $rt = Pengurus::find($id);

        $rt->nama = $request->nama;
        $rt->jabatan = $request->jabatan;
        $rt->nomor_telepon = $request->nomor_telepon;
        $rt->alamat = $request->alamat;

        $rt->save();

        return redirect('rw/data-rt');
    }

    public function delete($id)
    {
        $rt = Pengurus::find($id);
        $rt->delete();

        return redirect('rw/data-rt');
    }
}

