<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function main(Request $request)
    {
        $tab = $request->query('tab');

        $view = null;

        if ($tab == "info") {
            $view = $this->show_account_info();
        } else if ($tab == "notification") {
            $view = $this->show_notification();
        }

        return $view->with('tab', $tab);
    }

    private function show_account_info()
    {
        $user = User::with('pengurus')
            ->where('id_user', auth()->user()->id_user)
            ->first();

        return view('generals.account.index')->with('user', $user);
    }

    private function show_notification()
    {
        return view('generals.account.index');
    }

    public function update(Request $request, int $id)
    {
        $pengurus = Pengurus::find($id);

        $request->validate([
            'username' => ['required', 'unique:users,username,' . $pengurus->id_user . ',id_user'],
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email:dns'],
            'password' => ['min:8', 'max:20', 'regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'],
            'nomor_telepon' => ['required', 'max:13', 'unique:pengurus,nomor_telepon,' . $id . ',id_pengurus'],
            'alamat' => ['required', 'string', 'max:100']
        ]);

        $pengurus->update([
            'nama' => $request->nama,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
        ]);

        $user = User::find($pengurus->id_user);

        $user->update([
            'username' => $request->username,
        ]);

        if (isset($request->password)) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return redirect()->route('account.information', ['tab' => 'info']);
    }
}
