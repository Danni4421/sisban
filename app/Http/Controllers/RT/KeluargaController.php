<?php

namespace App\Http\Controllers\RT;

use App\DataTables\RT\KeluargaDataTable;
use App\Http\Controllers\Controller;
use App\Models\Keluarga;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KeluargaController extends Controller
{
    public ?KeluargaDataTable $dataTable;

    public function __construct()
    {
        $this->dataTable = app()->make(KeluargaDataTable::class);
    }

    public function index()
    {
        return $this->dataTable->render('rt.pages.keluarga.index');
    }

    public function create()
    {
        return view('rt.pages.keluarga.create');
    }

    public function store(Request $request)
    {
        Validator::validate(
            data: $request->all(),
            rules: [
                'no_kk' => 'required|size:16|unique:keluarga,no_kk',
                'nik' => 'required|size:16|unique:warga,nik',
                'nama' => 'required|max:100',
                'username' => 'required|unique:users,username|max:50',
                'email' => 'required|email:dns|max:100',
                'password' => 'required|min:8|max:20|regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
            ],
            messages: [
                'no_kk.required' => 'Nomor kartu keluarga perlu diisi.',
                'no_kk.size' => 'Ukuran Nomor kartu keluarga harus 16 digit.',
                'no_kk.unique' => 'Nomor kartu keluarga sudah digunakan.',
                'nik.required' => 'Nomor induk kependudukan perlu diisi.',
                'nik.size' => 'Nomor induk kependudukan harus 16 digit.',
                'nik.unique' => 'Nomor induk kependudukan sudah digunakan.',
                'nama.required' => 'Nama perlu untuk diisi.',
                'nama.max' => 'Maksimal panjang nama adalah 100 karakter.',
                'username.required' => 'Username perlu untuk diisi.',
                'username.unique' => 'Username telah digunakan.',
                'username.max'=> 'Username maksimal hanya boleh 50 karakter',
                'email.required' => 'Email perlu untuk diisi.',
                'email.email' => 'Email tidak valid.',
                'email.max' => 'Email hanya boleh maksimal 100 karakter.',
                'password.required' => 'Password perlu untuk diisi.',
                'password.min' => 'Password minimal yaitu 8 karakter.',
                'password.max' => 'Password maksimal yaitu 20 karakter.',
                'password.regex' => 'Password harus terdiri dari Huruf Besar, Huruf Kecil, Angka, dan Karakter.' 
            ]
        );

        $rt = substr(Auth::user()->pengurus->jabatan, 2);

         User::create([
            'username' => $request->username,
            'email'=> $request->email,
            'password' => $request->password,
            'level' => 'warga'
        ]);

        Keluarga::create([
            'no_kk' => $request->no_kk,
            'rt' => $rt
        ]);

        Warga::create([
            'nik' => $request->nik,
            'id_user' => User::where(['email' => $request->email])->first()->id_user,
            'no_kk' => $request->no_kk,
            'nama' => $request->nama,
            'jenis_kelamin' => 'lk'
        ]);

        return redirect()->to('/rt/keluarga');
    }

    public function destroy(string $no_kk)
    {
        $is_deleted_keluarga = Keluarga::with('kepala_keluarga')->where(['no_kk' => $no_kk])->first();

        if ($is_deleted_keluarga) {
            $id_user = '';
            if (!is_null($is_deleted_keluarga->kepala_keluarga)) {
                $id_user = $is_deleted_keluarga->kepala_keluarga->id_user;
            }

            $is_deleted_keluarga->delete();
            User::find($id_user)->delete();
            
            return response()->json([
                'success' => true,
            ]);
        }

        return response()->json([
            'success' => false
        ]);
    }
}
