<?php

namespace App\Livewire\Guest\Pengajuan\Steps;

use App\Models\Aset;
use App\Models\Keluarga;
use App\Models\Pengajuan;
use App\Models\Pengurus;
use App\Models\Warga;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\LivewireWizard\Components\StepComponent;

class PreviewFormStep extends StepComponent
{
    // Data Pemohon
    public string $nik_pemohon, $nama_pemohon, $jenis_kelamin_pemohon, $tempat_tanggal_lahir_pemohon, 
        $nomor_telepon_pemohon, $penghasilan_pemohon, $foto_ktp_pemohon;
    public int $umur_pemohon;

    // Data Keluarga
    public string $no_kk, $rt, $foto_kk;
    public array 
        $nik = [], 
        $nama = [], 
        $jenis_kelamin = [], 
        $umur = [],
        $tempat_tanggal_lahir = [],
        $nomor_telepon = [],
        $penghasilan = [];

    // Data Aset
    public array 
        $nama_aset = [],
        $tahun_beli = [],
        $harga_jual = [];

    // Data Ekonomi Keluarga
    public string 
        $daya_listrik;
    public int
        $biaya_listrik, $biaya_air, $hutang, $pengeluaran;

    // Input Keluarga
    public array $inputKeluarga = [];

    // Input Aset
    public array $inputAset = [];

    public function __construct()
    {
        if (session()->has('kepala-keluarga'))
        {
            $data = session()->get('kepala-keluarga');
            $this->nik_pemohon = $data['nik'];
            $this->nama_pemohon = $data['nama'];
            $this->jenis_kelamin_pemohon = $data['jenis_kelamin'];
            $this->umur_pemohon = $data['umur'];
            $this->tempat_tanggal_lahir_pemohon = $data['tempat_tanggal_lahir'];
            $this->nomor_telepon_pemohon = $data['nomor_telepon'];
            $this->penghasilan_pemohon = $data['penghasilan'];
            $this->foto_ktp_pemohon = $data['foto_ktp'];
        }
    
        if (session()->has('form-keluarga-input-index')) {
            $this->inputKeluarga = session()->get('form-keluarga-input-index');
        }

        if (session()->has('form-aset-input-index')){
            $this->inputAset = session()->get('form-aset-input-index');
        } else {
            $this->inputAset[] = 0;
        }
        
        if (session()->has('keluarga'))
        {
            $data = session()->get('keluarga');
            $this->no_kk = $data['no_kk'];
            $this->rt = $data['rt'];
            $this->foto_kk = $data['foto_kk'];
            $this->nik = $data['nik'];
            $this->nama = $data['nama'];
            $this->jenis_kelamin = $data['jenis_kelamin'];
            $this->umur = $data['umur'];
            $this->tempat_tanggal_lahir = $data['tempat_tanggal_lahir'];
            $this->nomor_telepon = $data['nomor_telepon'];
            $this->penghasilan = $data['penghasilan'];
        }

        if (session()->has('aset-keluarga')) 
        {
            $data = session()->get('aset-keluarga');
            $this->nama_aset = $data['nama_aset'];
            $this->tahun_beli = $data['tahun_beli'];
            $this->harga_jual = $data['harga_jual'];
        }

        if (session()->has('kondisi-ekonomi-keluarga'))
        {
            $data = session()->get('kondisi-ekonomi-keluarga');
            $this->daya_listrik = $data['daya_listrik'];
            $this->biaya_listrik = $data['biaya_listrik'];
            $this->biaya_air = $data['biaya_air'];
            $this->hutang = $data['hutang'];
            $this->pengeluaran = $data['pengeluaran'];
        }
    }

    public function submit()
    {
        $new_path_foto_kk = 'public/kk/'.last(explode('/', $this->foto_kk));
        Storage::move($this->foto_kk, $new_path_foto_kk);

        Keluarga::create([
            'no_kk' => $this->no_kk,
            'rt' => $this->rt,
            'daya_listrk' => $this->daya_listrik,
            'biaya_listrik' => $this->biaya_listrik,
            'biaya_air' => $this->biaya_air,
            'hutang' => $this->hutang,
            'pengeluaran' => $this->pengeluaran,
            'foto_kk' => $new_path_foto_kk,
        ]);

        $new_path_foto_ktp = 'public/ktp/'.last(explode('/', $this->foto_ktp_pemohon));
        Storage::move($this->foto_ktp_pemohon, $new_path_foto_ktp);

        Warga::create([
            'nik' => $this->nik_pemohon,
            'no_kk' => $this->no_kk,
            'nama' => $this->nama_pemohon,
            'jenis_kelamin' => $this->jenis_kelamin_pemohon,
            'tempat_tanggal_lahir' => $this->tempat_tanggal_lahir_pemohon,
            'no_hp' => $this->nomor_telepon_pemohon,
            'umur' => $this->umur_pemohon,
            'penghasilan' => $this->penghasilan_pemohon,
            'foto_ktp' => $new_path_foto_ktp,
            'level' => 'kepala_keluarga',
        ]);

        foreach ($this->map_anggota_keluarga() as $anggota_keluarga)  {
            Warga::create([
                'nik' => $anggota_keluarga->nik,
                'no_kk' => $this->no_kk,
                'nama' => $anggota_keluarga->nama,
                'jenis_kelamin' => $anggota_keluarga->jenis_kelamin,
                'tempat_tanggal_lahir' => $anggota_keluarga->tempat_tanggal_lahir,
                'no_hp' => $anggota_keluarga->no_hp,
                'umur' => $anggota_keluarga->umur,
                'penghasilan' => $anggota_keluarga->penghasilan,
                'level' => 'anggota',
            ]);
        }

        foreach ($this->map_aset_keluarga() as $aset_keluarga) {
            Aset::create([
                'no_kk' => $this->no_kk,
                'nama_aset' => $aset_keluarga->nama_aset,
                'harga_jual' => $aset_keluarga->harga_jual,
                'tahun_beli'=> $aset_keluarga->tahun_beli,
            ]);
        }

        Pengajuan::create([
            'no_kk' => $this->no_kk,
            'status_pengajuan' => 'proses',
        ]);

        session()->remove('kepala-keluarga');
        session()->remove('form-keluarga-input-index');
        session()->remove('form-aset-input-index');
        session()->remove('keluarga');
        session()->remove('aset-keluarga');
        session()->remove('kondisi-ekonomi-keluarga');
        session()->remove('currentStepIndex');

        return redirect('/pengajuan')->with('success', 'Pengajuan Anda Berhasil!');
    }

    private function map_anggota_keluarga()
    {
        return array_map(
            function($nik, $nama, $jenis_kelamin, $tempat_tanggal_lahir, $umur, $nomor_telepon, $penghasilan) {
                return (object) [
                    'nik' => $nik,
                    'nama'=> $nama,
                    'jenis_kelamin'=> $jenis_kelamin,
                    'tempat_tanggal_lahir'=> $tempat_tanggal_lahir,
                    'umur'=> $umur,
                    'no_hp'=> $nomor_telepon,
                    'penghasilan'=> $penghasilan,
                ];
            },
            $this->nik, 
            $this->nama, 
            $this->jenis_kelamin, 
            $this->tempat_tanggal_lahir, 
            $this->umur,
            $this->nomor_telepon,
            $this->penghasilan
        );
    }

    public function map_aset_keluarga()
    {
        return array_map(
            function($nama_aset, $tahun_beli, $harga_jual) {
                return (object) [
                    'nama_aset' => $nama_aset,
                    'tahun_beli'=> $tahun_beli,
                    'harga_jual'=> $harga_jual
                ];
            },
            $this->nama_aset,
            $this->tahun_beli,
            $this->harga_jual
        );
    }

    public function render()
    {
        return view('livewire.guest.pengajuan.steps.preview-form-step');
    }
}
