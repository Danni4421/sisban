<?php 

namespace App\Traits\Guest\Pengajuan;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait FormDataDiri {
    /**
     * @var string
     */
    public $nik_kepala_keluarga;
    
    /**
     * @var string
     */
    public $nama_kepala_keluarga;

    /**
     * @var string
     */
    public $jenis_kelamin_kepala_keluarga;

    /**
     * @var string
     */
    public $tempat_tanggal_lahir_kepala_keluarga;

    /**
     * @var int
     */
    public $umur_kepala_keluarga;

    /**
     * @var string
     */
    public $no_hp_kepala_keluarga;

    /**
     * @var UploadedFile | string
     */
    public $foto_ktp_kepala_keluarga;

    public function save_kepala_keluarga()
    {
        $this->validate([
            'nik_kepala_keluarga' => [
                'required' => 'Identitas diri NIK wajib untuk diisi', 
                'string', 
                'size:16' => 'Panjang nik harus 16 digit', 
                'unique:warga,nik' => 'NIK yang Anda masukkan sudah digunakan oleh pengguna lain'
            ],
            'nama_kepala_keluarga' => [
                'required' => 'Wajib mengisikan nama', 
                'string', 
                'max:100' => 'Panjang nama maksimal hanya boleh 100 karakter'
            ],
            'jenis_kelamin_kepala_keluarga' => [
                'required' => 'Jenis kelamin wajib untuk diisi', 
                'in:lk,pr' => 'Jenis kelamin yang dipilih hanya boleh laki laki dan perempuan saja'
            ],
            'tempat_tanggal_lahir_kepala_keluarga' => [
                'required' => 'Tempat tanggal lahir wajib untuk diisi', 
                'string', 
                'max:100' => 'Panjang tempat tanggal lahir hanya boleh 100 karakter'
            ],
            'umur_kepala_keluarga' => [
                'required' => 'Umur wajib untuk diisi', 
                'integer' => 'Umur hanya boleh diisi dengan nomor'
            ],
            'no_hp_kepala_keluarga' => [
                'required' => 'Nomor telepon wajib untuk diisi', 
                'string', 
                'max:13' => 'Maksimal panjang untuk nomor telepon adalah 13 digit'
            ],
            'foto_ktp' => [
                'required' => 'Foto KTP wajib untuk diisi',
                'image',
                'mime:img,jpg,jpeg,png' => 'Extensi foto ktp hanya menerima .img,.jpg,.png,.jpeg',
                'max:2048' => 'Ukuran maksimal adalah 2 mb'
            ]
        ]);
    }

    public function put_kepala_keluarga_into_session()
    {
        if (!is_null($this->foto_ktp_kepala_keluarga) && !is_string($this->foto_ktp_kepala_keluarga)) {
            $foto_ktp = $this->foto_ktp_kepala_keluarga->getClientOriginalName();
            $combined_foto_ktp_name = Str::uuid() . $foto_ktp;
            $upload_ktp = Storage::putFileAs('temp/images/ktp', $combined_foto_ktp_name);

            if ($upload_ktp) {
                session()->put('kepala_keluarga', [
                    'nik' => $this->nik_kepala_keluarga,
                    'nama' => $this->nama_kepala_keluarga,
                    'jenis_kelamin' => $this->jenis_kelamin_kepala_keluarga,
                    'tempat_tanggal_lahir' => $this->tempat_tanggal_lahir_kepala_keluarga,
                    'umur' => $this->umur_kepala_keluarga,
                    'no_hp' => $this->no_hp_kepala_keluarga,
                    'foto_ktp' => $combined_foto_ktp_name,
                ]);
            }
        }
    }

    public function load_kepala_keluarga_session()
    {
        if (session()->has('kepala_keluarga')) {
            $session = session()->get('kepala_keluarga');

            $this->nik_kepala_keluarga = $session['nik'];
            $this->nama_kepala_keluarga = $session['nama'];
            $this->jenis_kelamin_kepala_keluarga = $session['jenis_kelamin'];
            $this->tempat_tanggal_lahir_kepala_keluarga = $session['tempat_tanggal_lahir'];
            $this->umur_kepala_keluarga = $session['umur'];
            $this->no_hp_kepala_keluarga = $session['no_hp'];
            $this->foto_ktp_kepala_keluarga = $session['foto_ktp'];
        }
    }
}