<?php

namespace App\Livewire\Guest\Pengajuan\Steps;

use App\Models\Keluarga;
use App\Models\Notification;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;
use Spatie\LivewireWizard\Components\StepComponent;

class PreviewFormStep extends StepComponent
{
    /**
     * Data Pemohon
     */
    public ?string
        $nik_kepala_keluarga,
        $nama_kepala_keluarga,
        $jenis_kelamin_kepala_keluarga,
        $tempat_tanggal_lahir_kepala_keluarga,
        $nomor_telepon_kepala_keluarga,
        $status_kepala_keluarga,
        $penghasilan_kepala_keluarga,
        $foto_slip_gaji_kepala_keluarga = '',
        $foto_ktp_kepala_keluarga = '';
    public int $umur_kepala_keluarga;

    /**
     * Data Keluarga
     */
    public string
        $no_kk,
        $rt;
    public ?string $foto_kk;

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
        $status = [],
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
    public ?string
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
        $this->load_data();
    }

    public function submit()
    {
        $this->dispatch('submit');

        $no_kk = Auth::user()->warga->no_kk;
        $pengajuan = Pengajuan::where(['no_kk' => $no_kk])->first();

        /**
         * If pengajuan data is exists and have current status value is not either "diterima" | "proses"
         */
        if ($pengajuan && $pengajuan->status_pengajuan == "ditolak") {
            $pengajuan->update([
                'status_pengajuan' => 'proses'
            ]);
        } else if (is_null($pengajuan)) {
            Pengajuan::create([
                'no_kk' => $no_kk,
                'status_pengajuan' => 'proses',
            ]);
        } else {
            /**
             * If two condition is fail, then dispatch failed alert.
             */
            $this->dispatch('showFailPengajuanAlert', 'Gagal, Terdapat pengajuan yang belum dikonfirmasi');
            return null;
        }

        /**
         * Create new notification or update if exists
         */
        Notification::updateOrCreate([
            'no_kk' => $no_kk
        ], [
            'is_readed_rt' => false,
            'is_readed_rw' => false,
        ]);

        // Remove current form step session.
        session()->remove('current-form-step');

        // Dispatching web browser to show success alert.
        $this->dispatch('showAlertSuccess');

        // Sleep for a sec and redirect to landing page.
        sleep(3);
        return redirect()->to('/');
    }

    public function load_data()
    {
        $kepala_keluarga = Auth::user()->warga;

        /** 
         * Map Kepala Keluarga State
         */
        $this->nik_kepala_keluarga = $kepala_keluarga->nik ?? '';
        $this->nama_kepala_keluarga = $kepala_keluarga->nama ?? '';
        $this->jenis_kelamin_kepala_keluarga = $kepala_keluarga->jenis_kelamin ?? '';
        $this->tempat_tanggal_lahir_kepala_keluarga = $kepala_keluarga->tempat_tanggal_lahir ?? '';
        $this->umur_kepala_keluarga = $kepala_keluarga->umur ?? 0;
        $this->nomor_telepon_kepala_keluarga = $kepala_keluarga->no_hp ?? '';
        $this->status_kepala_keluarga = $kepala_keluarga->status ?? '';
        $this->penghasilan_kepala_keluarga = $kepala_keluarga->penghasilan ?? 0;
        $this->foto_slip_gaji_kepala_keluarga = $kepala_keluarga->slip_gaji;
        $this->foto_ktp_kepala_keluarga = $kepala_keluarga->foto_ktp;

        $family = Keluarga::with(['anggota_keluarga', 'aset', 'hutang'])
            ->where(['no_kk' => $kepala_keluarga->no_kk])->first();

        /**
         * Map Families Data
         */
        $this->no_kk = $family->no_kk;
        $this->rt = $family->rt;
        $this->foto_kk = $family->foto_kk;

        /**
         * Map Anggota Keluarga
         */
        array_map(
            function ($anggota) {
                $this->nik[] = $anggota["nik"];
                $this->nama[] = $anggota["nama"];
                $this->jenis_kelamin[] = $anggota["jenis_kelamin"];
                $this->tempat_tanggal_lahir[] = $anggota["tempat_tanggal_lahir"];
                $this->umur[] = $anggota["umur"];
                $this->nomor_telepon[] = $anggota["no_hp"];
                $this->status[] = $anggota["status"];
                $this->penghasilan[] = $anggota["penghasilan"];
                $this->slip_gaji[] = $anggota["slip_gaji"];
            },
            $family->anggota_keluarga->toArray()
        );

        $this->inputKeluarga = count($family->anggota_keluarga) > 0 ? range(0, count($family->anggota_keluarga) - 1) : [];

        /**
         * Map Aset Keluarga
         */
        array_map(
            function ($aset) {
                $this->nama_aset[] = $aset["nama_aset"];
                $this->harga_jual[] = $aset["harga_jual"];
                $this->tahun_beli[] = $aset["tahun_beli"];
                $this->foto_aset[] = $aset["image"];
            },
            $family->aset->toArray()
        );

        $this->inputAset = count($family->aset) > 0 ? range(0, count($family->aset) - 1) : [];

        /**
         * Map Family Economy Condition
         */
        $this->daya_listrik = $family->daya_listrik;
        $this->foto_tagihan_listrik = $family->bukti_biaya_listrik;
        $this->foto_tagihan_air = $family->bukti_biaya_air;
        $this->biaya_listrik = $family->biaya_listrik;
        $this->biaya_air = $family->biaya_air;
        $this->pengeluaran = $family->pengeluaran;

        /**
         * Map Family Loans
         */
        array_map(
            function ($hutang) {
                $this->hutang[] = $hutang["jumlah"];
                $this->deskripsi_hutang[] = $hutang["keterangan"];
                $this->foto_hutang[] = $hutang["bukti_hutang"];
            },
            $family->hutang->toArray(),
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
