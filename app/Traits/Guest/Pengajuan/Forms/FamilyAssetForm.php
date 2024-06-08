<?php

namespace App\Traits\Guest\Pengajuan\Forms;

use App\Models\Aset;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

    public function update_aset()
    {
        $no_kk = Auth::user()->warga->no_kk;

        for($i = 0; $i < count($this->nama_aset); $i++) {
            $asset = Aset::where([
                'no_kk' => $no_kk,
                'nama_aset' => $this->nama_aset[$i]
            ])->first();

            if (isset($this->foto_aset[$i]) && $this->foto_aset[$i] instanceof UploadedFile) {
                Validator::validate(
                    data: ['foto_aset'. $i => $this->foto_aset[$i]],
                    rules: [
                        'foto_aset'.$i => 'required|image|mimetypes:image/*|max:1024',
                    ],
                    messages: [
                        'required' => 'Mohon untuk menambahkan Foto Aset',
                        'image' => 'Anda hanya boleh menambahkan gambar',
                        'mimetypes' => 'Anda hanya boleh menambahkan file berupa gambar',
                        'max' => 'Maksimal ukuran dari foto ktp adalah 2 MB'
                    ]
                );

                if ($asset && !is_null($asset->image)) {
                    Storage::delete($asset->image);
                }

                $original_image_name = $this->foto_aset[$i]->getClientOriginalName();
                $image_name = Str::uuid() . '-' . $original_image_name;

                $this->foto_aset[$i] = $this->foto_aset[$i]->storeAs(
                    path: 'images/assets',
                    name: $image_name,
                );

                Aset::updateOrCreate(
                    [
                        'no_kk' => $no_kk,
                        'nama_aset' => $this->nama_aset[$i],
                    ],
                    [
                        'nama_aset' => $this->nama_aset[$i],
                        'harga_jual' => $this->harga_jual[$i],
                        'tahun_beli' => $this->tahun_beli[$i],
                        'image' => $this->foto_aset[$i]
                    ]
                );
            }
        }
    }

    public function load_data()
    {
        $assets = Aset::where(['no_kk' => Auth::user()->warga->no_kk])->get()->toArray();

        session()->put('form-asset-input-index', count($assets));

        if (!empty($assets)) {
            array_map(
                function($asset) {
                    $this->nama_aset[] = $asset["nama_aset"];
                    $this->harga_jual[] = $asset["harga_jual"];
                    $this->tahun_beli[] = $asset["tahun_beli"];
                    $this->foto_aset[] = $asset["image"];
                },
                $assets
            );
        }
    }
}
