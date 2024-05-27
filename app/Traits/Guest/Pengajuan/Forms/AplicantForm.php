<?php

namespace App\Traits\Guest\Pengajuan\Forms;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

trait AplicantForm
{
    #[Validate(
        rule: [
            'nik' => 'required|numeric|digits:16|unique:warga,nik',
        ],
        message: [
            'nik.required' => 'NIK perlu untuk diisi',
            'nik.numeric' => 'NIK harus berupa Angka',
            'nik.digits' => 'Panjang NIK harus 16 digit',
            'nik.unique' => 'NIK yang Anda masukkan sama dengan warga lain',
        ]
    )]
    public string $nik;

    #[Validate(
        rule: [
            'nama' => 'required|max:100'
        ],
        message: [
            'nama.required' => 'Nama perlu untuk diisi',
            'nama.max' => 'Panjang nama tidak boleh lebih dari 100 karakter',
        ]
    )]
    public string $nama;

    #[Validate(
        rule: [
            'jenis_kelamin' => 'required|in:lk,pr'
        ],
        message: [
            'jenis_kelamin.required' => 'Jenis kelamin perlu untuk dipilih',
            'jenis_kelamin.in' => 'Jenis kelamin yang dimasukkan hanya boleh antara Laki Laki dan Perempuan'
        ]
    )]
    public string $jenis_kelamin;

    #[Validate(
        rule: [
            'tempat_tanggal_lahir' => 'required|max:100',
        ],
        message: [
            'tempat_tanggal_lahir.required' => 'Tempat dan tanggal lahir perlu diisi',
            'tempat_tanggal_lahir.max' => 'Panjng tempat dan tanggal lahir tidak boleh lebih dari 100 karakter'
        ]
    )]
    public string $tempat_tanggal_lahir;

    #[Validate(
        rule: [
            'umur' => 'required|integer'
        ],
        message: [
            'umur.required' => 'Umur perlu untuk diisi',
            'umur.integer' => 'Umur harus berupa angka'
        ]
    )]
    public int $umur;

    #[Validate(
        rule: [
            'nomor_telepon' => 'required|numeric|max_digits:13'
        ],
        message: [
            'nomor_telepon.required' => 'Nomor telepon perlu untuk diisi',
            'nomor_telepon.numeric' => 'Nomor telepon harus berupa angka',
            'nomor_telepon.max_digits' => 'Maksimal nomor telepon tidak boleh lebih dari 13 digit'
        ]
    )]
    public string $nomor_telepon;

    #[Validate(
        rule: [
            'status' => 'required|string|in:bekerja,tidak_bekerja,sekolah'
        ],
        message: [
            'status.required' => 'Status pekerjaan perlu untuk diisi',
            'status.string' => 'Status harus berupa karakter',
            'status.in' => 'Status harus antara Bekerja, Tidak Bekerja, atau Sekolah'
        ]
    )]
    public string $status;
    public array $available_status = [
        'bekerja' => 'Bekerja',
        'tidak_bekerja' => 'Tidak Bekerja',
        'sekolah' => 'Sekolah'
    ];


    #[Validate(
        rule: [
            'penghasilan' => 'required|integer'
        ],
        message: [
            'penghasilan.required' => 'Penghasilan perlu untuk diisi',
            'penghasilan.integer' => 'Penghasilan harus berupa angka'
        ]
    )]
    public int $penghasilan;

    /**
     * @var \Illuminate\Http\UploadedFile | string
     */
    public $slip_gaji;

    /**
     * @var \Illuminate\Http\UploadedFile | string
     */
    public $foto_ktp;

    public function validate_image_request()
    {
        if ($this->slip_gaji instanceof UploadedFile) {
            Validator::validate(
                data: ['slip_gaji' => $this->slip_gaji],
                rules: [
                    'slip_gaji' => 'required|image|mimetypes:image/*|max:1024'
                ],
                messages: [
                    'required' => 'Mohon untuk menambahkan slip gaji',
                    'image' => 'Anda hanya boleh menambahkan gambar',
                    'mimetypes' => 'Anda hanya boleh menambahkan file berupa gambar',
                    'max' => 'Maksimal ukuran dari slip gaji adalah 1 MB'
                ]
            );

            $original_slip_gaji_name = $this->slip_gaji->getClientOriginalName();
            $image_name = Str::uuid() . '-' . $original_slip_gaji_name;

            $this->slip_gaji = $this->slip_gaji->storeAs(
                path: 'temp/images/slip_gaji',
                name: $image_name
            );
        }

        if ($this->foto_ktp instanceof UploadedFile) {
            Validator::validate(
                data: ['foto_ktp' => $this->foto_ktp],
                rules: [
                    'foto_ktp' => 'required|image|mimetypes:image/*|max:2048'
                ],
                messages: [
                    'required' => 'Mohon untuk menambahkan foto KTP',
                    'image' => 'Anda hanya boleh menambahkan gambar',
                    'mimetypes' => 'Anda hanya boleh menambahkan file berupa gambar',
                    'max' => 'Maksimal ukuran dari foto ktp adalah 2 MB'
                ]
            );

            $original_image_name = $this->foto_ktp->getClientOriginalName();
            $image_name = Str::uuid() . '-' . $original_image_name;

            $this->foto_ktp = $this->foto_ktp->storeAs(
                path: 'temp/images/ktp',
                name: $image_name,
            );
        }
    }

    public function put_form_session()
    {
        session()->put('kepala-keluarga', [
            'nik' => $this->nik,
            'nama' => $this->nama,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_tanggal_lahir' => $this->tempat_tanggal_lahir,
            'umur' => $this->umur,
            'nomor_telepon' => $this->nomor_telepon,
            'status' => $this->status,
            'penghasilan' => $this->penghasilan,
            'slip_gaji' => $this->slip_gaji,
            'foto_ktp' => $this->foto_ktp,
        ]);
    }

    public function load_from_session()
    {
        $sessionData = $this->getSessionData();

        if (!empty($sessionData)) {
            $this->nik = $sessionData['nik'];
            $this->nama = $sessionData['nama'];
            $this->jenis_kelamin = $sessionData['jenis_kelamin'];
            $this->tempat_tanggal_lahir = $sessionData['tempat_tanggal_lahir'];
            $this->umur = $sessionData['umur'];
            $this->nomor_telepon = $sessionData['nomor_telepon'];
            $this->status = $sessionData['status'];
            $this->penghasilan = $sessionData['penghasilan'];
            $this->slip_gaji = $sessionData['slip_gaji'];
            $this->foto_ktp = $sessionData['foto_ktp'];
        }
    }
}
