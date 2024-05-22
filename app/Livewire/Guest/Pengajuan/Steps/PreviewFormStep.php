<?php

namespace App\Livewire\Guest\Pengajuan\Steps;

use App\Models\Aset;
use App\Models\Hutang;
use App\Models\Keluarga;
use App\Models\Pengajuan;
use App\Models\Warga;
use Illuminate\Support\Facades\Storage;
use Spatie\LivewireWizard\Components\StepComponent;

class PreviewFormStep extends StepComponent
{
    /**
     * Data Pemohon
     */
    public string
        $nik_pemohon,
        $nama_pemohon,
        $jenis_kelamin_pemohon,
        $tempat_tanggal_lahir_pemohon,
        $nomor_telepon_pemohon,
        $penghasilan_pemohon,
        $foto_slip_gaji_pemohon,
        $foto_ktp_pemohon;
    public int $umur_pemohon;

    /**
     * Data Keluarga
     */
    public string
        $no_kk,
        $rt,
        $foto_kk;

    /**
     * Data Anggota Keluarga
     */
    public array
        $nik = [],
        $nama = [],
        $jenis_kelamin = [],
        $umur = [],
        $tempat_tanggal_lahir = [],
        $nomor_telepon = [],
        $slip_gaji = [],
        $penghasilan = [];

    /**
     * Data Aset Keluarga
     */
    public array
        $nama_aset = [],
        $tahun_beli = [],
        $harga_jual = [],
        $foto_aset = [];

    /**
     * Data Ekonomi Keluarga
     */
    public string
        $daya_listrik,
        $foto_tagihan_listrik,
        $foto_tagihan_air;
    public int
        $biaya_listrik,
        $biaya_air,
        $pengeluaran;
    public array $hutang = [];
    public array $deskripsi_hutang = [];
    public array $foto_hutang = [];

    /**
     * Input Section Form Anggota Keluarga
     */
    public array $inputKeluarga = [];

    /**
     * Input Section Form Aset Keluarga
     */
    public array $inputAset = [];

    public function __construct()
    {
        /**
         * Get session pemohon pengajuan
         */
        if (session()->has('kepala-keluarga')) {
            $data = session()->get('kepala-keluarga');
            $this->nik_pemohon = $data['nik'];
            $this->nama_pemohon = $data['nama'];
            $this->jenis_kelamin_pemohon = $data['jenis_kelamin'];
            $this->umur_pemohon = $data['umur'];
            $this->tempat_tanggal_lahir_pemohon = $data['tempat_tanggal_lahir'];
            $this->nomor_telepon_pemohon = $data['nomor_telepon'];
            $this->penghasilan_pemohon = $data['penghasilan'];
            $this->foto_slip_gaji_pemohon = $data['slip_gaji'];
            $this->foto_ktp_pemohon = $data['foto_ktp'];
        }

        if (session()->has('form-keluarga-inputs')) {
            $this->inputKeluarga = session()->get('form-keluarga-inputs');
        }

        if (session()->has('form-aset-inputs')) {
            $this->inputAset = session()->get('form-aset-inputs');
        }

        /**
         * Get session data keluarga and anggota keluarga
         */
        if (session()->has('keluarga')) {
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
            $this->slip_gaji = $data['slip_gaji'];
            $this->penghasilan = $data['penghasilan'];
        }

        /**
         * Get session data aset keluarga
         */
        if (session()->has('aset-keluarga')) {
            $data = session()->get('aset-keluarga');
            $this->nama_aset = $data['nama_aset'];
            $this->tahun_beli = $data['tahun_beli'];
            $this->harga_jual = $data['harga_jual'];
            $this->foto_aset = $data['foto_aset'];
        }

        /**
         * Get session data kondisi ekonomi keluarga
         */
        if (session()->has('kondisi-ekonomi-keluarga')) {
            $data = session()->get('kondisi-ekonomi-keluarga');
            $this->daya_listrik = $data['daya_listrik'];
            $this->biaya_listrik = $data['biaya_listrik'];
            $this->foto_tagihan_listrik = $data['foto_tagihan_listrik'];
            $this->biaya_air = $data['biaya_air'];
            $this->foto_tagihan_air = $data['foto_tagihan_air'];
            $this->hutang = $data['hutang'];
            $this->deskripsi_hutang = $data['deskripsi_hutang'];
            $this->foto_hutang = $data['foto_hutang'];
            $this->pengeluaran = $data['pengeluaran'];
        }
    }

    public function submit()
    {
        /**
         * Generate new path for Foto KK
         */
        $new_path_foto_kk = 'public/kk/' . last(explode('/', $this->foto_kk));
        Storage::move($this->foto_kk, $new_path_foto_kk);

        /**
         * Generate new path for Foto Tagihan Listrik
         */
        global $new_path_foto_tagihan_listrik;

        if ($this->foto_tagihan_listrik != "") {
            $new_path_foto_tagihan_listrik = 'public/tagihan_listrik' . last(explode('/', $this->foto_tagihan_listrik));
            Storage::move($this->foto_tagihan_listrik, $new_path_foto_tagihan_listrik);
        }

        /**
         * Generate new path for Foto Tagihan Air
         */
        global $new_path_foto_tagihan_air;

        if ($this->foto_tagihan_air != "") {
            $new_path_foto_tagihan_air = 'public/tagihan_air' . last(explode('/', $this->foto_tagihan_air));
            Storage::move($this->foto_tagihan_air, $new_path_foto_tagihan_air);
        }

        /**
         * Insert new data keluarga in database
         */
        Keluarga::create([
            'no_kk' => $this->no_kk,
            'rt' => $this->rt,
            'daya_listrk' => $this->daya_listrik,
            'biaya_listrik' => $this->biaya_listrik,
            'bukti_biaya_listrik' => $new_path_foto_tagihan_listrik,
            'biaya_air' => $this->biaya_air,
            'bukti_biaya_air' => $new_path_foto_tagihan_air,
            'pengeluaran' => $this->pengeluaran,
            'foto_kk' => $new_path_foto_kk,
        ]);

        /**
         * Iterating for each hutang
         */
        foreach ($this->map_hutang_keluarga() as $hutang) {
            $new_path_image_hutang = 'public/hutang' . last(explode('/', $hutang->bukti_hutang));
            Storage::move($hutang->bukti_hutang, $new_path_image_hutang);

            Hutang::create([
                'no_kk' => $this->no_kk,
                'jumlah' => $hutang->jumlah,
                'keterangan' => $hutang->keterangan,
                'bukti_hutang' => $new_path_image_hutang,
            ]);
        }

        /**
         * Generate new path for foto KTP pemohon
         */
        $new_path_foto_ktp = 'public/ktp/' . last(explode('/', $this->foto_ktp_pemohon));
        Storage::move($this->foto_ktp_pemohon, $new_path_foto_ktp);

        /**
         * Generate new path for foto slip gaji pemohon
         */
        $new_path_slip_gaji_pemohon = 'public/slip_gaji' . last(explode('/', $this->foto_slip_gaji_pemohon));
        Storage::move($this->foto_slip_gaji_pemohon, $new_path_slip_gaji_pemohon);

        /**
         * Insert new data pemohon as kepala keluarga in database
         */
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
            'slip_gaji' => $new_path_slip_gaji_pemohon,
            'level' => 'kepala_keluarga',
        ]);



        /**
         * Iterating for each anggota keluarga and insert into database
         */
        foreach ($this->map_anggota_keluarga() as $anggota_keluarga) {
            /**
             * Generating new path for slip gaji anggota keluarga
             */
            $new_path_slip_gaji_anggota = 'public/slip_gaji' . last(explode('/', $anggota_keluarga->slip_gaji));
            Storage::move($anggota_keluarga->slip_gaji, $new_path_slip_gaji_anggota);

            Warga::create([
                'nik' => $anggota_keluarga->nik,
                'no_kk' => $this->no_kk,
                'nama' => $anggota_keluarga->nama,
                'jenis_kelamin' => $anggota_keluarga->jenis_kelamin,
                'tempat_tanggal_lahir' => $anggota_keluarga->tempat_tanggal_lahir,
                'no_hp' => $anggota_keluarga->no_hp,
                'umur' => $anggota_keluarga->umur,
                'penghasilan' => $anggota_keluarga->penghasilan,
                'slip_gaji' => $new_path_slip_gaji_anggota,
                'level' => 'anggota',
            ]);
        }

        /**
         * Iterating for each asset of keluarga and insert into database
         */
        foreach ($this->map_aset_keluarga() as $aset_keluarga) {
            $new_path_aset = 'public/slip_gaji' . last(explode('/', $aset_keluarga->foto_aset));
            Storage::move($aset_keluarga->foto_aset, $new_path_aset);

            Aset::create([
                'no_kk' => $this->no_kk,
                'nama_aset' => $aset_keluarga->nama_aset,
                'harga_jual' => $aset_keluarga->harga_jual,
                'tahun_beli' => $aset_keluarga->tahun_beli,
                'image' => $new_path_aset,
            ]);
        }

        /**
         * Make new pengajuan on table pengajuan
         */
        Pengajuan::create([
            'no_kk' => $this->no_kk,
            'status_pengajuan' => 'proses',
        ]);

        /**
         * Remove session for pengajuan
         */
        session()->remove('kepala-keluarga');
        session()->remove('form-keluarga-input-index');
        session()->remove('form-aset-input-index');
        session()->remove('keluarga');
        session()->remove('aset-keluarga');
        session()->remove('kondisi-ekonomi-keluarga');
        session()->remove('currentStepIndex');

        /**
         * Redirecting back to first page
         */
        return redirect('/pengajuan')->with('success', 'Pengajuan Anda Berhasil!');
    }

    /**
     * Mapping anggota keluarga to be one array
     */
    private function map_anggota_keluarga()
    {
        return array_map(
            function ($nik, $nama, $jenis_kelamin, $tempat_tanggal_lahir, $umur, $nomor_telepon, $penghasilan, $slip_gaji) {
                return (object) [
                    'nik' => $nik,
                    'nama' => $nama,
                    'jenis_kelamin' => $jenis_kelamin,
                    'tempat_tanggal_lahir' => $tempat_tanggal_lahir,
                    'umur' => $umur,
                    'no_hp' => $nomor_telepon,
                    'penghasilan' => $penghasilan,
                    'slip_gaji' => $slip_gaji,
                ];
            },
            $this->nik,
            $this->nama,
            $this->jenis_kelamin,
            $this->tempat_tanggal_lahir,
            $this->umur,
            $this->nomor_telepon,
            $this->penghasilan,
            $this->slip_gaji,
        );
    }

    /**
     * Mapping asset keluarga to be one array
     */
    public function map_aset_keluarga()
    {
        return array_map(
            function ($nama_aset, $tahun_beli, $harga_jual, $foto_aset) {
                return (object) [
                    'nama_aset' => $nama_aset,
                    'tahun_beli' => $tahun_beli,
                    'harga_jual' => $harga_jual,
                    'foto_aset' => $foto_aset,
                ];
            },
            $this->nama_aset,
            $this->tahun_beli,
            $this->harga_jual,
            $this->foto_aset,
        );
    }

    function map_hutang_keluarga()
    {
        return array_map(
            function ($hutang, $deskripsi, $foto_hutang) {
                return (object) [
                    'jumlah' => $hutang,
                    'keterangan' => $deskripsi,
                    'bukti_hutang' => $foto_hutang
                ];
            },
            $this->hutang,
            $this->deskripsi_hutang,
            $this->foto_hutang,
        );
    }

    /**
     * Render preview page
     */
    public function render()
    {
        return view('livewire.guest.pengajuan.steps.preview-form-step');
    }
}
