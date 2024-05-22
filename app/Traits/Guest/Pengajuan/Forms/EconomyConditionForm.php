<?php

namespace App\Traits\Guest\Pengajuan\Forms;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

trait EconomyConditionForm
{

    #[Validate(
        rule: [
            'daya_listrik' => 'required|in:none,450,900,1300'
        ],
        message: [
            'required' => 'Daya listrik perlu untuk diisi',
            'in' => 'Daya listrik antara None, 450, 900, 1300'
        ]
    )]
    public $daya_listrik;

    #[Validate(
        rule: [
            'biaya_listrik' => 'required|integer',
        ],
        message: [
            'required' => 'Biaya listrik perlu untuk diisi',
            'integer' => 'Biaya listrik harus berupa angka'
        ]
    )]
    public $biaya_listrik;

    #[Validate(
        rule: [
            'biaya_air' => 'required|integer',
        ],
        message: [
            'required' => 'Biaya air perlu untuk diisi',
            'integer' => 'Biaya air harus berupa angka'
        ]
    )]
    public $biaya_air;

    #[Validate(
        rule: [
            'hutang' => 'required|array|max:15',
            'hutang.*' => 'required|numeric'
        ],
        message: [
            'required' => 'Hutang perlu untuk diisi',
            'max' => 'Maksimal hutang yang boleh dimasukan adalah 15',
            'hutang.*.required' => 'Hutang ini wajib untuk diisi',
            'hutang.*.numeric' => 'Nilai hutang harus berupa angka',
        ]
    )]
    public $hutang = [];

    #[Validate(
        rule: [
            'deskripsi_hutang' => 'required|array|max:15',
            'deskripsi_hutang.*' => 'required|string'
        ],
        message: [
            'required' => 'Hutang perlu untuk diisi',
            'max' => 'Maksimal hutang yang boleh dimasukan adalah 15',
            'deskripsi_hutang.*.required' => 'Hutang ini wajib untuk diisi',
            'deskripsi_hutang.*.string' => 'Nilai hutang harus berupa karakter',
        ]
    )]
    public $deskripsi_hutang = [];

    #[Validate(
        rule: [
            'pengeluaran' => 'required|integer',
        ],
        message: [
            'required' => 'Pengeluaran perlu untuk diisi',
            'integer' => 'Pengeluaran harus berupa angka'
        ]
    )]
    public $pengeluaran;

    public UploadedFile | string $foto_tagihan_listrik = "";

    public UploadedFile | string  $foto_tagihan_air = "";

    /**
     * @var array<int, string> | array<int, UploadedFile>
     */
    public $foto_hutang = [];

    public function validate_image_request()
    {
        if ($this->foto_tagihan_listrik instanceof UploadedFile) {
            Validator::validate(
                data: ['foto_tagihan_listrik' => $this->foto_tagihan_listrik],
                rules: [
                    'foto_tagihan_listrik' => 'required|image|mimetypes:image/*|max:2048'
                ],
                messages: [
                    'required' => 'Mohon untuk menambahkan foto tagihan listrik',
                    'image' => 'Anda hanya boleh menambahkan gambar',
                    'mimetypes' => 'Anda hanya boleh menambahkan file berupa gambar',
                    'max' => 'Maksimal ukuran dari foto ktp adalah 2 MB'
                ]
            );

            $original_image_name = $this->foto_tagihan_listrik->getClientOriginalName();
            $image_name = Str::uuid() . '-' . $original_image_name;

            $this->foto_tagihan_listrik = $this->foto_tagihan_listrik->storeAs(
                path: 'temp/images/tagihan_listrik',
                name: $image_name,
            );
        }

        if ($this->foto_tagihan_air instanceof UploadedFile) {
            Validator::validate(
                data: ['foto_tagihan_air' => $this->foto_tagihan_air],
                rules: [
                    'foto_tagihan_air' => 'required|image|mimetypes:image/*|max:2048'
                ],
                messages: [
                    'required' => 'Mohon untuk menambahkan foto tagihan air',
                    'image' => 'Anda hanya boleh menambahkan gambar',
                    'mimetypes' => 'Anda hanya boleh menambahkan file berupa gambar',
                    'max' => 'Maksimal ukuran dari foto ktp adalah 2 MB'
                ]
            );

            $original_image_name = $this->foto_tagihan_air->getClientOriginalName();
            $image_name = Str::uuid() . '-' . $original_image_name;

            $this->foto_tagihan_air = $this->foto_tagihan_air->storeAs(
                path: 'temp/images/tagihan_air',
                name: $image_name,
            );
        }

        if (!empty($this->foto_hutang)) {
            foreach ($this->foto_hutang as $key => $value) {
                if ($value instanceof UploadedFile) {
                    Validator::validate(
                        data: ['foto_hutang' => $value],
                        rules: [
                            'foto_hutang' => 'image|mimetypes:image/*|max:1024',
                        ],
                        messages: [
                            'image' => 'Anda hanya boleh menambahkan gambar',
                            'mimetypes' => 'Anda hanya boleh menambahkan file berupa gambar',
                            'max' => 'Maksimal ukuran dari foto ktp adalah 1 MB'
                        ]
                    );

                    $original_image_name = $value->getClientOriginalName();
                    $image_name = Str::uuid() . '-' . $original_image_name;

                    $this->foto_hutang[$key] = $value->storeAs(
                        path: 'temp/images/tagihan_air',
                        name: $image_name,
                    );
                }
            }
        }
    }

    public function put_form_session()
    {
        session()->put('kondisi-ekonomi-keluarga', [
            'daya_listrik' => $this->daya_listrik,
            'biaya_listrik' => $this->biaya_listrik,
            'biaya_air' => $this->biaya_air,
            'hutang' => $this->hutang,
            'deskripsi_hutang' => $this->deskripsi_hutang,
            'pengeluaran' => $this->pengeluaran,
            'foto_tagihan_listrik' => $this->foto_tagihan_listrik,
            'foto_tagihan_air' => $this->foto_tagihan_air,
            'foto_hutang' => $this->foto_hutang
        ]);
    }

    public function load_from_session()
    {
        $sessionData = session()->get('kondisi-ekonomi-keluarga');

        if (!empty($sessionData)) {
            $this->daya_listrik = $sessionData['daya_listrik'];
            $this->biaya_listrik = $sessionData['biaya_listrik'];
            $this->biaya_air = $sessionData['biaya_air'];
            $this->hutang = $sessionData['hutang'];
            $this->deskripsi_hutang = $sessionData['deskripsi_hutang'];
            $this->pengeluaran = $sessionData['pengeluaran'];
            $this->foto_tagihan_listrik = $sessionData['foto_tagihan_listrik'];
            $this->foto_tagihan_air = $sessionData['foto_tagihan_air'];
            $this->foto_hutang = $sessionData['foto_hutang'];
        }
    }
}
