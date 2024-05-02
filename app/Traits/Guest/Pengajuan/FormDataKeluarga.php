<?php

namespace App\Traits\Guest\Pengajuan;

trait FormDataKeluarga {
    /**
     * @var string
     */
    public $no_kk;

    /**
     * @var \Illuminate\Http\UploadedFile | string
     */
    public $foto_kk;

    /**
     * @var array<string>
     */
    public $nik = [];

    /**
     * @var array<string>
     */
    public $nama = [];

    /**
     * @var array<string>
     */
    public $jenis_kelamin = [];

    /**
     * @var array<string>
     */
    public $tempat_tanggal_lahir = [];

    /**
     * @var array<int>
     */
    public $umur = [];

    /**
     * @var array<string>
     */
    public $no_hp = [];

    /**
     * @var array<\Illuminate\Http\UploadedFile | string>
     */
    public $foto_ktp = [];

    public function save_data_keluarga()
    {
        dd($this);
        $this->validate([
            
        ]);
    }
}