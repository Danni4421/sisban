<?php

namespace App\Traits\Guest\Pengajuan\Forms;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

trait FamilyForm
{
    #[Validate(
        rule: [
            'no_kk' => 'required|numeric|digits:16|unique:keluarga,no_kk'
        ],
        message: [
            'no_kk.required' => 'Nomor Kartu Keluarga perlu untuk diisi',
            'no_kk.numeric' => 'Nomor Kartu Keluarga harus terdiri dari kombinasi Angka',
            'no_kk.digits' => 'Panjang Nomor Kartu Keluarga adalah 16 karakter',
            'no_kk.unique' => 'Nomor Kartu Keluarga yang Anda masukkan sudah digunakan',
        ]
    )]
    public string $no_kk = '';

    #[Validate(
        rule: [
            'rt' => 'required|numeric|digits:3',
        ],
        message: [
            'rt.required' => 'RT perlu untuk diisi',
            'rt.numeric' => 'RT harus berupa angka',
            'rt.digits' => 'RT hanya boleh terdiri dari 3 digit'
        ]
    )]
    public string $rt = '';

    /**
     * @var array<int, string>
     */
    public $list_rt = [
        '025', '026', '027', '028', '029', '030', '031'
    ];

    /**
     * @var \Illuminate\Http\UploadedFile | string
     */
    public $foto_kk;

    #[Validate(
        rule: [
            'nik' => 'array|max:15|min:0',
            'nik.*' => 'required|numeric|digits:16|unique:warga,nik',
        ],
        message: [
            'nik.max' => 'Maksimal anggota keluarga adalah 15',
            'nik.*.required' => 'NIK perlu untuk diisi',
            'nik.*.numeric' => 'NIK harus terdiri dari kombinasi Angka',
            'nik.*.digits' => 'Panjang NIK adalah 16 karakter',
            'nik.*.unique' => 'NIK yang Anda masukkan sudah digunakan',
        ]
    )]
    public array $nik = [];

    #[Validate(
        rule: [
            'nama' => 'array|max:15|min:0',
            'nama.*' => 'required|string|max:100',
        ],
        message: [
            'nama.max' => 'Maksimal anggota keluarga adalah 15',
            'nama.*.required' => 'Nama perlu untuk diisi',
            'nama.*.string' => 'Nama harus berupa karakter',
            'nama.*.max' => 'Panjang Nama hanya boleh sampai 100 karakter',
        ]
    )]
    public array $nama = [];

    #[Validate(
        rule: [
            'jenis_kelamin' => 'array|max:15|min:0',
            'jenis_kelamin.*' => 'required|string|in:lk,pr',
        ],
        message: [
            'jenis_kelamin.max' => 'Maksimal anggota keluarga adalah 15',
            'jenis_kelamin.*.required' => 'Jenis kelamin perlu untuk diisi',
            'jenis_kelamin.*.string' => 'Jenis kelamin harus berupa karakter',
            'jenis_kelamin.*.in' => 'Jenis kelamin yang boleh dimasukkan hanya Laki Laki dan Perempuan',
        ]
    )]
    public array $jenis_kelamin = [];

    #[Validate(
        rule: [
            'tempat_tanggal_lahir' => 'array|max:15|min:0',
            'tempat_tanggal_lahir.*' => 'required|string|max:100',
        ],
        message: [
            'tempat_tanggal_lahir.max' => 'Maksimal anggota keluarga adalah 15',
            'tempat_tanggal_lahir.*.required' => 'Tempat tanggal lahir perlu untuk diisi',
            'tempat_tanggal_lahir.*.string' => 'Tempat tanggal lahir harus berupa karakter',
            'tempat_tanggal_lahir.*.max' => 'Panjang tempat tanggal lahir hanya boleh sampai 100 karakter',
        ]
    )]
    public array $tempat_tanggal_lahir = [];

    #[Validate(
        rule: [
            'umur' => 'array|max:15|min:0',
            'umur.*' => 'required|numeric',
        ],
        message: [
            'umur.max' => 'Maksimal anggota keluarga adalah 15',
            'umur.*.required' => 'Umur perlu untuk diisi',
            'umur.*.numeric' => 'Umur harus terdiri dari Angka',
        ]
    )]
    public array $umur = [];

    #[Validate(
        rule: [
            'nomor_telepon' => 'array|max:15|min:0',
            'nomor_telepon.*' => 'required|numeric|max_digits:13|unique:warga,no_hp',
        ],
        message: [
            'nomor_telepon.max' => 'Maksimal anggota keluarga adalah 15',
            'nomor_telepon.*.required' => 'Nomor telepon perlu untuk diisi',
            'nomor_telepon.*.numeric' => 'Nomor telepon harus terdiri dari Angka',
            'nomor_telepon.*.max' => 'Panjang nomor telepon maksimal adalah 13 digit',
            'nomor_telepon.*.unique' => 'Nomor telepon yang Anda masukkan sudah digunakan',
        ]
    )]
    public array $nomor_telepon = [];

    #[Validate(
        rule: [
            'status' => 'array|max:15|min:0',
            'status.*' => 'required|string|in:bekerja,tidak_bekerja,sekolah',
        ],
        message: [
            'status.max' => 'Maksimal anggota keluarga adalah 15',
            'status.*.required' => 'Status pekerjaan perlu untuk diisi',
            'status.*.string' => 'Status harus berupa karakter',
            'status.*.in' => 'Status harus antara Bekerja, Tidak Bekerja, atau Sekolah'
        ]
    )]
    public array $status = [];

    #[Validate(
        rule: [
            'penghasilan' => 'array|max:15|min:0',
            'penghasilan.*' => 'required|integer',
        ],
        message: [
            'penghasilan.max' => 'Maksimal anggota keluarga adalah 15',
            'penghasilan.*.required' => 'Penghasilan perlu untuk diisi',
            'penghasilan.*.integer' => 'Penghasilan harus berupa Angka'
        ]
    )]
    public array $penghasilan = [];

    /**
     * @var array<int, string> | array<int, UploadedFile>
     */
    public $slip_gaji = [];

    public function update_keluarga(): void
    {
        session()->put('keluarga', [
            'no_kk' => $this->no_kk,
            'rt' => $this->rt,
            'foto_kk' => $this->foto_kk,
            'nik' => $this->nik,
            'nama' => $this->nama,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_tanggal_lahir' => $this->tempat_tanggal_lahir,
            'umur' => $this->umur,
            'nomor_telepon' => $this->nomor_telepon,
            'status' => $this->status,
            'penghasilan' => $this->penghasilan,
            'slip_gaji' => $this->slip_gaji
        ]);
    }

    public function put_form_session()
    {
        $sessionData = session()->get('keluarga');

        if (!empty($sessionData)) {
            $this->no_kk = $sessionData["no_kk"];
            $this->rt = $sessionData["rt"];
            $this->foto_kk = $sessionData["foto_kk"];
            $this->nik = $sessionData["nik"];
            $this->nama = $sessionData["nama"];
            $this->jenis_kelamin = $sessionData["jenis_kelamin"];
            $this->tempat_tanggal_lahir = $sessionData["tempat_tanggal_lahir"];
            $this->umur = $sessionData["umur"];
            $this->nomor_telepon = $sessionData["nomor_telepon"];
            $this->status = $sessionData["status"];
            $this->penghasilan = $sessionData["penghasilan"];
            $this->slip_gaji = $sessionData["slip_gaji"];
        }
    }

    public function validate_image_request()
    {
        if ($this->foto_kk instanceof UploadedFile) {
            Validator::validate(
                data: ['foto_kk' => $this->foto_kk],
                rules: [
                    'foto_kk' => [
                        'required', 'image', 'mimetypes:image/*', 'max:2048',
                    ],
                ],
                messages: [
                    'required' => 'Mohon untuk menambahkan Foto KK',
                    'image' => 'Anda hanya boleh menambahkan gambar',
                    'mimetypes' => 'Anda hanya boleh menambahkan file berupa gambar',
                    'max' => 'Maksimal ukuran dari foto ktp adalah 2 MB'
                ]
            );

            $original_image_name = $this->foto_kk->getClientOriginalName();
            $image_name = Str::uuid() . '-' . $original_image_name;

            $this->foto_kk = $this->foto_kk->storeAs(
                path: 'temp/images/kk',
                name: $image_name
            );
        }

        foreach ($this->slip_gaji as $key => $value) {
            if ($value instanceof UploadedFile) {
                Validator::validate(
                    data: ['slip_gaji' . $key => $value],
                    rules: [
                        'slip_gaji' . $key => 'image|mimetypes:image/*|max:1024'
                    ],
                    messages: [
                        'image' => 'Anda hanya boleh menambahkan gambar',
                        'mimetypes' => 'Anda hanya boleh menambahkan file berupa gambar',
                        'max' => 'Maksimal ukuran dari foto ktp adalah 2 MB'
                    ]
                );

                $original_image_name = $value->getClientOriginalName();
                $image_name = Str::uuid() . '-' . $original_image_name;

                $this->slip_gaji[$key] = $value->storeAs(
                    path: 'temp/images/slip_gaji',
                    name: $image_name
                );
            }
        }
    }
}
