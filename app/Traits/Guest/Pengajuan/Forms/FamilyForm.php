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
        ], message: [
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
     * @var \Illuminate\Http\UploadedFile | string
     */
    public $foto_kk;

    #[Validate(
        rule: [
            'nik' => 'required|array|max:15',
            'nik.*' => 'required|numeric|digits:16|unique:warga,nik',
        ], 
        message: [
            'nik' => 'NIK perlu untuk diisi',
            'nik.*.required' => 'NIK perlu untuk diisi',
            'nik.*.numeric' => 'NIK harus terdiri dari kombinasi Angka',
            'nik.*.digits' => 'Panjang NIK adalah 16 karakter',
            'nik.*.unique' => 'NIK yang Anda masukkan sudah digunakan',
        ]
    )]
    public array $nik = [];

    #[Validate( 
        rule: [
            'nama' => 'required|array|max:15',
            'nama.*' => 'required|string|max:100',
        ], 
        message: [
            'nama' => 'Nama perlu untuk diisi',
            'nama.*.required' => 'Nama perlu untuk diisi',
            'nama.*.string' => 'Nama harus berupa karakter',
            'nama.*.max' => 'Panjang Nama hanya boleh sampai 100 karakter',
        ]
    )]
    public array $nama = [];

    #[Validate(
        rule: [
            'jenis_kelamin' => 'required|array|max:15',
            'jenis_kelamin.*' => 'required|string|in:lk,pr',
        ], 
        message: [
            'jenis_kelamin' => 'Jenis kelamin perlu untuk diisi',
            'jenis_kelamin.*.required' => 'Jenis kelamin perlu untuk diisi',
            'jenis_kelamin.*.string' => 'Jenis kelamin harus berupa karakter',
            'jenis_kelamin.*.in' => 'Jenis kelamin yang boleh dimasukkan hanya Laki Laki dan Perempuan',
        ]
    )]
    public array $jenis_kelamin = [];

    #[Validate(
        rule: [
            'tempat_tanggal_lahir' => 'required|array|max:15',
            'tempat_tanggal_lahir.*' => 'required|string|max:100',
        ],
        message: [
            'tempat_tanggal_lahir' => 'Tempat tanggal lahir perlu untuk diisi',
            'tempat_tanggal_lahir.*.required' => 'Tempat tanggal lahir perlu untuk diisi',
            'tempat_tanggal_lahir.*.string' => 'Tempat tanggal lahir harus berupa karakter',
            'tempat_tanggal_lahir.*.max' => 'Panjang tempat tanggal lahir hanya boleh sampai 100 karakter',
        ]
    )]
    public array $tempat_tanggal_lahir = [];

    #[Validate(
        rule: [
            'umur' => 'required|array|max:15',
            'umur.*' => 'required|numeric',
        ],
        message: [
            'umur' => 'Umur perlu untuk diisi',
            'umur.*.required' => 'Umur perlu untuk diisi',
            'umur.*.numeric' => 'Umur harus terdiri dari Angka',
        ]
    )]
    public array $umur = [];

    #[Validate(
        rule: [
            'nomor_telepon' => 'required|array|max:15',
            'nomor_telepon.*' => 'required|numeric|max_digits:13|unique:warga,no_hp',
        ],
        message: [
            'nomor_telepon' => 'Nomor telepon perlu untuk diisi',
            'nomor_telepon.*.required' => 'Nomor telepon perlu untuk diisi',
            'nomor_telepon.*.numeric' => 'Nomor telepon harus terdiri dari Angka',
            'nomor_telepon.*.max' => 'Panjang nomor telepon maksimal adalah 13 digit',
            'nomor_telepon.*.unique' => 'Nomor telepon yang Anda masukkan sudah digunakan',
        ]
    )]
    public array $nomor_telepon = [];

    #[Validate(
        rule: [
            'penghasilan' => 'required|array|max:15',
            'penghasilan.*'=> 'required|integer',
        ],
        message: [
            'penghasilan' => 'Penghasilan perlu untuk diisi',
            'penghasilan.*.required' => 'Penghasilan perlu untuk diisi',
            'penghasilan.*.integer' => 'Penghasilan harus berupa Angka'
        ]
    )]
    public array $penghasilan = [];

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
            'penghasilan' => $this->penghasilan,
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
            $this->penghasilan = $sessionData["penghasilan"];
        }
    }

    public function validate_image_request()
    {
        if ($this->foto_kk instanceof UploadedFile) {
            Validator::validate(['foto_kk' => $this->foto_kk], [
                'foto_kk' => [
                    'required', 'image', 'mimetypes:image/*', 'max:2048',
                ],
            ]);
        }

        if (!is_null($this->foto_kk) && !is_string($this->foto_kk)) {
            $original_image_name = $this->foto_kk->getClientOriginalName();
            $image_name = Str::uuid() . '-' . $original_image_name;   

            $this->foto_kk = $this->foto_kk->storeAs(
                path: 'temp/images/kk', 
                name: $image_name,
                options: [],
            );
        }
    }
}
