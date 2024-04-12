<?php

namespace App\Traits;

use App\Models\User;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Collection;

trait ManageRT {

  /**
   * Getting RT Users
   * 
   * @param ?int $id
   * 
   * @return Collection
   */
   private function getRT($id = null)
   {
      $pengurusQuery = Pengurus::select('id_pengurus', 'id_user', 'jabatan', 'nama', 'nomor_telepon', 'alamat')
          ->with('user')
          ->whereHas('user', function ($query) {
              $query->where('level', 'rt');
          });

      if (!is_null($id)) {
        return $pengurusQuery->where('id_pengurus', $id)->first();
      }

      return $pengurusQuery->get(); 
    }

    /**
     * Adding pengurus RT
     * 
     * @param Request $request
     * 
     * @return void
     */
    private function storeRT($request)
    {
      $user_level = 'rt';

      $request->validate([
        'username' => ['required', 'string', 'min:4', 'max:50', 'unique:users,username'],
        'email' => ['required', 'email:dns', 'max:100', 'unique:users,email'],
        'password' => ['required', 'min:8' ,'max:20'],
        'jabatan' => ['required', 'string', 'max:11', 'unique:pengurus,jabatan'],
        'nama' => ['required', 'string', 'max:100'],
        'nomor_telepon' => ['required', 'max:13', 'unique:pengurus,nomor_telepon'],
        'alamat' => ['required', 'string', 'max:100']
      ]);

      $newUser = User::make([
        'username' => $request->username,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'level' => $user_level,
      ]); 

      $newUser->save();

      Pengurus::create([
        'id_user' => $newUser->id_user,
        'jabatan' => $request->jabatan,
        'nama' => $request->nama,
        'nomor_telepon' => $request->nomor_telepon,
        'alamat' => $request->alamat,
      ]);
    }

    /**
     * Update pengurus RT
     * 
     * @param Request $request
     * @param int $id
     * 
     * @return void
     */
    private function updateRT($request, $id)
    {
      $request->validate([
        'jabatan' => ['required', 'string', 'max:11', 'unique:pengurus,jabatan,' . $id . ',id_pengurus'],
        'nama' => ['required', 'string', 'max:100'],
        'nomor_telepon' => ['required', 'max:13', 'unique:pengurus,nomor_telepon,' . $id . ',id_pengurus'],
        'alamat' => ['required', 'string', 'max:100']
      ]);

      Pengurus::find($id)->update([
        'jabatan' => $request->jabatan,
        'nama' => $request->nama,
        'nomor_telepon' => $request->nomor_telepon,
        'alamat' => $request->alamat,
      ]);
    }


    /**
     * Delete pengurus RT
     * 
     * @param int $id
     * 
     * @return void
     */
    private function deleteRT($id)
    {
      Pengurus::with('user')->find($id)->delete();
    }
}