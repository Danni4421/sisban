<?php

namespace App\Traits\Guest\Pengajuan\Forms;

use App\Models\Keluarga;
use App\Models\Warga;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

trait FamilyForm
{
    #[Validate(
        rule: [
            'no_kk' => 'required|numeric|digits:16|distinct'
        ],
        message: [
            'no_kk.required' => 'Nomor Kartu Keluarga perlu untuk diisi',
            'no_kk.numeric' => 'Nomor Kartu Keluarga harus terdiri dari kombinasi Angka',
            'no_kk.digits' => 'Panjang Nomor Kartu Keluarga adalah 16 karakter',
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

    /**
     * @var array
     */
    public $aplicant;

    #[Validate(
        rule: [
            'nik' => 'array|max:15|min:0',
            'nik.*' => 'required|numeric|digits:16|distinct',
        ],
        message: [
            'nik.max' => 'Maksimal anggota keluarga adalah 15',
            'nik.*.required' => 'NIK perlu untuk diisi',
            'nik.*.numeric' => 'NIK harus terdiri dari kombinasi Angka',
            'nik.*.digits' => 'Panjang NIK adalah 16 karakter',
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
            'nomor_telepon.*' => 'required|numeric|max_digits:13|distinct',
        ],
        message: [
            'nomor_telepon.max' => 'Maksimal anggota keluarga adalah 15',
            'nomor_telepon.*.required' => 'Nomor telepon perlu untuk diisi',
            'nomor_telepon.*.numeric' => 'Nomor telepon harus terdiri dari Angka',
            'nomor_telepon.*.max' => 'Panjang nomor telepon maksimal adalah 13 digit',
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

    public function save_image_kk()
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

            if (!is_null($this->foto_kk)) {
                Storage::delete($this->foto_kk);
            }

            $original_image_name = $this->foto_kk->getClientOriginalName();
            $image_name = Str::uuid() . '-' . $original_image_name;

            $this->foto_kk = $this->foto_kk->storeAs(
                path: 'images/kk',
                name: $image_name
            );

            Keluarga::where(['no_kk' => $this->aplicant['no_kk']])->update([
                'foto_kk' => $this->foto_kk
            ]);
        }
    }

    public function update_keluarga(): void
    {
        Keluarga::where(['no_kk' => $this->aplicant['no_kk']])
            ->update([
                'no_kk' => $this->no_kk,
                'rt' => $this->rt,
            ]);

        for ($i = 0; $i < count($this->nik); $i++) {
            $warga = Warga::where(['nik' => $this->nik[$i]])->first();

            if (isset($this->slip_gaji[$i]) && $this->slip_gaji[$i] instanceof UploadedFile) {
                Validator::validate(
                    data: ['slip_gaji' . $i => $this->slip_gaji[$i]],
                    rules: [
                        'slip_gaji' . $i => 'image|mimetypes:image/*|max:1024'
                    ],
                    messages: [
                        'image' => 'Anda hanya boleh menambahkan gambar',
                        'mimetypes' => 'Anda hanya boleh menambahkan file berupa gambar',
                        'max' => 'Maksimal ukuran dari foto ktp adalah 2 MB'
                    ]
                );

                if ($warga && !is_null($warga->slip_gaji)) {
                    Storage::delete($warga->slip_gaji);
                }

                $original_image_name = $this->slip_gaji[$i]->getClientOriginalName();
                $image_name = Str::uuid() . '-' . $original_image_name;

                $this->slip_gaji[$i] = $this->slip_gaji[$i]->storeAs(
                    path: 'images/slip_gaji',
                    name: $image_name
                );
            }

            Warga::updateOrInsert(
                attributes: [
                    'nik' => $this->nik[$i]
                ],
                values: [
                    'nik' => $this->nik[$i],
                    'no_kk' => $this->no_kk,
                    'nama' => $this->nama[$i],
                    'jenis_kelamin' => $this->jenis_kelamin[$i],
                    'tempat_tanggal_lahir' => $this->tempat_tanggal_lahir[$i],
                    'umur' => $this->umur[$i],
                    'no_hp' => $this->nomor_telepon[$i],
                    'status' => $this->status[$i],
                    'penghasilan' => $this->penghasilan[$i],
                    'level' => 'anggota',
                    'slip_gaji' => isset($this->slip_gaji[$i]) ? $this->slip_gaji[$i] : null
                ]
            );
        }
    }

    public function load_data()
    {
        $this->aplicant = Auth::user()->warga->toArray();

        $family = Keluarga::where(['no_kk' => $this->aplicant['no_kk']])->orderBy('created_at')->first();

        $this->no_kk = $family->no_kk ?? '';
        $this->rt = $family->rt ?? '';
        $this->foto_kk = $family->foto_kk ?? '';

        $anggota_keluarga = Warga::where(['no_kk' => $this->no_kk])
            ->whereNot('nik', $this->aplicant['nik'])->get()->toArray();

        session()->put('form-keluarga-input-index', count($anggota_keluarga));

        if (!empty($anggota_keluarga)) {
            array_map(
                function ($anggota) {
                    $this->nik[] = $anggota["nik"] ?? '';
                    $this->nama[] = $anggota["nama"] ?? '';
                    $this->jenis_kelamin[] = $anggota['jenis_kelamin'] ?? '';
                    $this->tempat_tanggal_lahir[] = $anggota['tempat_tanggal_lahir'] ?? '';
                    $this->umur[] = $anggota['umur'] ?? '';
                    $this->nomor_telepon[] = $anggota['no_hp'] ?? '';
                    $this->status[] = $anggota['status'] ?? '';
                    $this->penghasilan[] = $anggota['penghasilan'] ?? '';
                    $this->slip_gaji[] = $anggota['slip_gaji'] ?? '';
                },
                $anggota_keluarga
            );
        }
    }

    public function validate_image_request()
    {
        if (is_null($this->foto_kk)) {
            throw ValidationException::withMessages([
                'foto_kk' => 'Foto KK Wajib Diisi',
            ]);
        }
    }
}
