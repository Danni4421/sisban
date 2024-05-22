<?php

namespace App\Traits\Guest\Pengajuan\Forms;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

trait FamilyAssetForm
{

    #[Validate(
        rule: [
            'nama_aset' => 'required|array|max:30',
            'nama_aset.*' => 'required|string|max:50',
        ],
        message: [
            'required' => 'Nama aset perlu untuk diisi',
            'max' => 'Maksimal aset yang boleh ditambahkan hanya boleh 30 aset',
            'nama_aset.*.required' => 'Nama aset perlu untuk diisi',
            'nama_aset.*.string' => 'Nama aset harus berupa karakter',
            'nama_aset.*.max' => 'Panjang Nama aset adalah 50 karakter',
        ]
    )]
    public $nama_aset = [];

    #[Validate(
        rule: [
            'tahun_beli' => 'required|array|max:30',
            'tahun_beli.*' => 'required|numeric|digits:4',
        ],
        message: [
            'required' => 'Tahun beli perlu untuk diisi',
            'max' => 'Maksimal aset yang boleh ditambahkan hanya boleh 30 aset',
            'tahun_beli.*.required'  => 'Tahun beli perlu untuk diisi',
            'tahun_beli.*.numeric' => 'Tahun beli harus berupa angka',
            'tahun_beli.*.digits' => 'Tahun beli terdiri dari 4 digit angka',
        ]
    )]
    public $tahun_beli = [];

    #[Validate(
        rule: [
            'harga_jual' => 'required|array|max:30',
            'harga_jual.*' => 'required|integer',
        ],
        message: [
            'required' => 'Harga jual perlu untuk diisi',
            'max' => 'Maksimal aset yang boleh ditambahkan hanya boleh 30 aset',
            'harga_jual.*.required' => 'Harga jual perlu untuk diisi',
            'harga_jual.*.integer' => 'Harga jual harus berupa angka'
        ]
    )]
    public $harga_jual = [];

    /**
     * @var array<int, string> | array<int, UploadedFile>
     */
    public $foto_aset = [];

    public function validate_image_request()
    {
        if (!empty($this->foto_aset)) {
            foreach ($this->foto_aset as $key => $value) {
                if ($value instanceof UploadedFile) {
                    Validator::validate(
                        data: ['foto_aset' => $value],
                        rules: [
                            'foto_aset' => 'required|image|mimetypes:image/*|max:1024',
                        ],
                        messages: [
                            'required' => 'Mohon untuk menambahkan Foto Aset',
                            'image' => 'Anda hanya boleh menambahkan gambar',
                            'mimetypes' => 'Anda hanya boleh menambahkan file berupa gambar',
                            'max' => 'Maksimal ukuran dari foto ktp adalah 2 MB'
                        ]
                    );

                    $original_image_name = $value->getClientOriginalName();
                    $image_name = Str::uuid() . '-' . $original_image_name;

                    $this->foto_aset[$key] = $value->storeAs(
                        path: 'temp/images/aset',
                        name: $image_name,
                    );
                }
            }
        }
    }

    public function put_form_session()
    {
        session()->put('aset-keluarga', [
            'nama_aset' => $this->nama_aset,
            'tahun_beli' => $this->tahun_beli,
            'harga_jual' => $this->harga_jual,
            'foto_aset' => $this->foto_aset
        ]);
    }

    public function load_from_session()
    {
        $sessionData = session()->get('aset-keluarga');

        if (!empty($sessionData)) {
            $this->nama_aset = $sessionData['nama_aset'];
            $this->tahun_beli = $sessionData['tahun_beli'];
            $this->harga_jual = $sessionData['harga_jual'];
            $this->foto_aset = $sessionData['foto_aset'];
        }
    }
}
