<?php

namespace App\Traits;

use App\Models\User;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Collection;

trait ManageRT
{

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

    $rules = [
      'username' => [
        'required',
        'string',
        'min:4',
        'max:50',
        'unique:users,username'
      ],
      'email' => [
        'required',
        'email:dns',
        'max:100',
        'unique:users,email'
      ],
      'password' => [
        'required',
        'min:8',
        'max:20',
        'regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'
      ],
      'jabatan' => [
        'required',
        'string',
        'max:11',
        'unique:pengurus,jabatan'
      ],
      'nama' => [
        'required',
        'string',
        'max:100'
      ],
      'nomor_telepon' => [
        'required',
        'numeric',
        'unique:pengurus,nomor_telepon'
      ],
      'alamat' => [
        'required',
        'string',
        'max:100'
      ]
    ];

    $messages = [
      'username.required' => 'Username wajib untuk diisi.',
      'username.string' => 'Username harus berupa karakter.',
      'username.min' => 'Username minimal harus terdiri dari 4 karakter.',
      'username.max' => 'Username maksimal adalah 50 karakter.',
      'username.unique' => 'Username sudah dipakai.',
      'email.required' => 'Email wajib untuk diisi.',
      'email.email' => 'Email harus berupa alamat email yang valid.',
      'email.max' => 'Email maksimal adalah 100 karakter.',
      'email.unique' => 'Email sudah dipakai.',
      'password.required' => 'Password wajib untuk diisi.',
      'password.min' => 'Password minimal harus terdiri dari 8 karakter.',
      'password.max' => 'Password maksimal adalah 20 karakter.',
      'password.regex' => 'Password harus mengandung huruf dan angka.',
      'jabatan.required' => 'Jabatan wajib untuk diisi.',
      'jabatan.string' => 'Jabatan harus berupa karakter.',
      'jabatan.max' => 'Jabatan maksimal adalah 11 karakter.',
      'jabatan.unique' => 'Jabatan sudah dipakai.',
      'nama.required' => 'Nama wajib untuk diisi.',
      'nama.string' => 'Nama harus berupa karakter.',
      'nama.max' => 'Nama maksimal adalah 100 karakter.',
      'nomor_telepon.required' => 'Nomor telepon wajib untuk diisi.',
      'nomor_telepon.unique' => 'Nomor telepon sudah dipakai.',
      'nomor_telepon.numeric' => 'Nomor telepon harus berupa angka.',
      'alamat.required' => 'Alamat wajib untuk diisi.',
      'alamat.string' => 'Alamat harus berupa karakter.',
      'alamat.max' => 'Alamat maksimal adalah 100 karakter.'
    ];

    $request->validate($rules, $messages);

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
    $rules = [
      'jabatan' => [
        'required',
        'string',
        'max:11',
        'unique:pengurus,jabatan,' . $id . ',id_pengurus'
      ],
      'nama' => [
        'required',
        'string',
        'max:100'
      ],
      'nomor_telepon' => [
        'required',
        'numeric',
        'unique:pengurus,nomor_telepon,' . $id . ',id_pengurus'
      ],
      'alamat' => [
        'required',
        'string',
        'max:100'
      ]
    ];

    $messages = [
      'jabatan.required' => 'Jabatan wajib untuk diisi.',
      'jabatan.string' => 'Jabatan harus berupa karakter.',
      'jabatan.max' => 'Jabatan maksimal adalah 11 karakter.',
      'jabatan.unique' => 'Jabatan sudah dipakai.',
      'nama.required' => 'Nama wajib untuk diisi.',
      'nama.string' => 'Nama harus berupa karakter.',
      'nama.max' => 'Nama maksimal adalah 100 karakter.',
      'nomor_telepon.required' => 'Nomor telepon wajib untuk diisi.',
      'nomor_telepon.numeric' => 'Nomor telepon harus berupa angka.',
      'nomor_telepon.unique' => 'Nomor telepon sudah dipakai.',
      'alamat.required' => 'Alamat wajib untuk diisi.',
      'alamat.string' => 'Alamat harus berupa karakter.',
      'alamat.max' => 'Alamat maksimal adalah 100 karakter.'
    ];

    $request->validate($rules, $messages);

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
    $rt = Pengurus::find($id);
    User::find($rt->id_user)->delete();
  }
}
