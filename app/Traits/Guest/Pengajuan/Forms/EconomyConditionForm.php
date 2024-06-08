<?php

namespace App\Traits\Guest\Pengajuan\Forms;

use App\Models\Hutang;
use App\Models\Keluarga;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

    /**
     * @var array
     */
    public $id_hutang = [];

    #[Validate(
        rule: [
            'hutang' => 'array|max:15|min:0',
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
            'deskripsi_hutang' => 'array|max:15|min:0',
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
            'pengeluaran' => 'integer',
        ],
        message: [
            'required' => 'Pengeluaran perlu untuk diisi',
            'integer' => 'Pengeluaran harus berupa angka'
        ]
    )]
    public $pengeluaran;

    /**
     * @var string | UploadedFile
     */
    public $foto_tagihan_listrik = "";

    /**
     * @var string | UploadedFile
     */
    public $foto_tagihan_air = "";

    /**
     * @var array<int, string> | array<int, UploadedFile>
     */
    public $foto_hutang = [];

    public function save_image_tagihan()
    {
        $keluarga = Keluarga::where(['no_kk' => Auth::user()->warga->no_kk])->first();

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

            if ($keluarga && !is_null($keluarga->bukti_biaya_listrik)) {
                Storage::delete($keluarga->bukti_biaya_listrik);
            }

            $original_image_name = $this->foto_tagihan_listrik->getClientOriginalName();
            $image_name = Str::uuid() . '-' . $original_image_name;

            $this->foto_tagihan_listrik = $this->foto_tagihan_listrik->storeAs(
                path: 'images/tagihan_listrik',
                name: $image_name,
            );

            $keluarga->update([
                'bukti_biaya_listrik' => $this->foto_tagihan_listrik,
            ]);
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

            if ($keluarga && !is_null($keluarga->bukti_biaya_air)) {
                Storage::delete($keluarga->bukti_biaya_air);
            }

            $original_image_name = $this->foto_tagihan_air->getClientOriginalName();
            $image_name = Str::uuid() . '-' . $original_image_name;

            $this->foto_tagihan_air = $this->foto_tagihan_air->storeAs(
                path: 'images/tagihan_air',
                name: $image_name,
            );

            $keluarga->update([
                'bukti_biaya_air' => $this->foto_tagihan_air,
            ]);
        }
    }

    public function update_data()
    {
        $no_kk = Auth::user()->warga->no_kk;

        Keluarga::where(['no_kk' => $no_kk])->update([
            'daya_listrik' => $this->daya_listrik,
            'biaya_listrik' => $this->biaya_listrik,
            'biaya_air' => $this->biaya_air,
            'pengeluaran' => $this->pengeluaran,
        ]);

        for($i = 0; $i < count($this->hutang); $i++) {
            $id_hutang = isset($this->id_hutang[$i]) ? $this->id_hutang[$i] : null;
            $hutang = Hutang::where(['id_hutang' => $id_hutang])->first();

            if (isset($this->foto_hutang[$i]) && $this->foto_hutang[$i] instanceof UploadedFile) {
                Validator::validate(
                    data: ['foto_hutang' => $this->foto_hutang[$i]],
                    rules: [
                        'foto_hutang' => 'image|mimetypes:image/*|max:1024',
                    ],
                    messages: [
                        'image' => 'Anda hanya boleh menambahkan gambar',
                        'mimetypes' => 'Anda hanya boleh menambahkan file berupa gambar',
                        'max' => 'Maksimal ukuran dari foto ktp adalah 1 MB'
                    ]
                );

                if ($hutang && !is_null($hutang->bukti_hutang)) {
                    Storage::delete($hutang->bukti_hutang);
                }

                $original_image_name = $this->foto_hutang[$i]->getClientOriginalName();
                $image_name = Str::uuid() . '-' . $original_image_name;

                $this->foto_hutang[$i] = $this->foto_hutang[$i]->storeAs(
                    path: 'images/hutang',
                    name: $image_name,
                );
            }

            Hutang::updateOrCreate(
                [
                    'id_hutang' => $id_hutang
                ],
                [
                    'no_kk' => $no_kk,
                    'jumlah' => $this->hutang[$i],
                    'keterangan' => $this->deskripsi_hutang[$i],
                    'bukti_hutang' => isset($this->foto_hutang[$i]) ? $this->foto_hutang[$i] : null
                ]
            );
        }
    }

    public function load_data()
    {
        $keluarga = Keluarga::where(['no_kk' => Auth::user()->warga->no_kk])->first();
        $hutangs = Hutang::where(['no_kk' => $keluarga->no_kk])->get()->toArray();

        $this->daya_listrik = $keluarga->daya_listrik;
        $this->biaya_listrik = $keluarga->biaya_listrik;
        $this->biaya_air = $keluarga->biaya_air;
        $this->pengeluaran = $keluarga->pengeluaran;
        $this->foto_tagihan_listrik = $keluarga->bukti_biaya_listrik;
        $this->foto_tagihan_air = $keluarga->bukti_biaya_air;

        session()->put('form-economy-loan-index', count($hutangs));

        array_map(
            function($hutang) {
                $this->id_hutang[] = $hutang["id_hutang"];
                $this->hutang[] = $hutang["jumlah"];
                $this->deskripsi_hutang[] = $hutang["keterangan"];
                $this->foto_hutang[] = $hutang["bukti_hutang"];
            },
            $hutangs
        );
    }
}
