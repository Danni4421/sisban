<?php

namespace App\Traits\Guest\Pengajuan\Forms;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;

trait FamilyAssetForm {

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

    public function put_form_session()
    {
        session()->put('aset-keluarga', [
            'nama_aset' => $this->nama_aset,
            'tahun_beli'=> $this->tahun_beli,
            'harga_jual'=> $this->harga_jual
        ]);
    }

    public function load_from_session()
    {
        $sessionData = session()->get('aset-keluarga');

        if (!empty($sessionData)) {
            $this->nama_aset = $sessionData['nama_aset'];
            $this->tahun_beli = $sessionData['tahun_beli'];
            $this->harga_jual = $sessionData['harga_jual'];
        }
    }
}