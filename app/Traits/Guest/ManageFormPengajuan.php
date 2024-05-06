<?php

namespace App\Traits\Guest;

use App\Livewire\Guest\Forms\FormAset;
use App\Livewire\Guest\Forms\FormDataDiri;
use App\Livewire\Guest\Forms\FormDataKeluarga;
use App\Livewire\Guest\Forms\FormKondisiEkonomi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

trait ManageFormPengajuan {

  private $FORM_PENGAJUAN_PROPERTIES;

  public function __construct()
  {
    $this->FORM_PENGAJUAN_PROPERTIES = [
      'form_data_diri' => [
          'header_title' => 'Data Diri (Kepala Keluarga)',
          'component' => FormDataDiri::class,
      ],
      'form_data_keluarga' => [
          'header_title' => 'Data Keluarga',
          'component' => FormDataKeluarga::class,
      ],
      'form_aset' => [
          'header_title' => 'Data Aset Keluarga',
          'component' => FormAset::class,
      ],
      'form_kondisi_keluarga' => [
          'header_title' => 'Data Kondisi Ekonomi',
          'component' => FormKondisiEkonomi::class,
      ],
    ];
  }

  /**
   * Get class component from form index
   * 
   * @param string $form
   * 
   * @return string | null
   */
  public function getFormComponent($form)
    {
      $keyIndex = 1;

      foreach($this->FORM_PENGAJUAN_PROPERTIES as $value) {
        if ((int) $form == $keyIndex) {
          return $value["component"];
        }

        $keyIndex++;
      } 

      return null;
    }

    /**
     * Get form header title from form index
     * 
     * @param string $form
     * 
     * @return string
     */
    public function getFormTitle($form)
    {
      $keyIndex = 1;

      foreach($this->FORM_PENGAJUAN_PROPERTIES as $value) {
        if ((int) $form == $keyIndex) {
          return $value["header_title"];
        }

        $keyIndex++;
      } 

      return null;
    }

    public function save_form_data_diri(Request $request)
    {
      $request->validate([
        'nik' => [
          'required' => 'Identitas diri NIK wajib untuk diisi', 
          'string', 
          'size:16' => 'Panjang nik harus 16 digit', 
          'unique:warga,nik' => 'NIK yang Anda masukkan sudah digunakan oleh pengguna lain'
        ],
        'nama' => [
          'required' => 'Wajib mengisikan nama', 
          'string', 
          'max:100' => 'Panjang nama maksimal hanya boleh 100 karakter'
        ],
        'jenis_kelamin' => [
          'required' => 'Jenis kelamin wajib untuk diisi', 
          'in:lk,pr' => 'Jenis kelamin yang dipilih hanya boleh laki laki dan perempuan saja'
        ],
        'tempat_tanggal_lahir' => [
          'required' => 'Tempat tanggal lahir wajib untuk diisi', 
          'string', 
          'max:100' => 'Panjang tempat tanggal lahir hanya boleh 100 karakter'
        ],
        'umur' => [
          'required' => 'Umur wajib untuk diisi', 
          'integer' => 'Umur hanya boleh diisi dengan nomor'
        ],
        'no_hp' => [
          'required' => 'Nomor telepon wajib untuk diisi', 
          'string', 
          'max:13' => 'Maksimal panjang untuk nomor telepon adalah 13 digit'
        ],
        'foto_ktp' => [
          File::types(['img', 'jpg', 'png', 'jpeg']) => 'Extensi foto ktp hanya menerima .img,.jpg,.png,.jpeg',
        ]
      ]);

      session()->put('form-data-diri', [
        'nik' => $request->nik,
        'nama' => $request->nama,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tempat_tanggal_lahir' => $request->tempat_tanggal_lahir
      ]);
    }
}