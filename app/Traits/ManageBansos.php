<?php

namespace App\Traits;

use App\Models\Bansos;
use App\Models\Keluarga;
use App\Models\PenerimaBansos;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

trait ManageBansos
{

  /**
   * @param Request $request
   * 
   * @return void
   */
  public function createNewBansos(Request $request)
  {
    $rules = [
      'nama_bansos' => [
        'required',
        'string',
        'max:100',
        'unique:bansos,nama_bansos'
      ],
      'keterangan' => [
        'required',
        'string'
      ],
      'jumlah' => [
        'required',
        'numeric',
        'min:0'
      ]
    ];

    $messages = [
      'nama_bansos.required' => 'Nama bansos wajib untuk diisi.',
      'nama_bansos.string' => 'Nama bansos harus berupa karakter.',
      'nama_bansos.max' => 'Maksimal nama bansos adalah 100 karakter.',
      'nama_bansos.unique' => 'Nama bansos sudah dipakai.',
      'keterangan.required' => 'Keterangan bansos harus diisi.',
      'keterangan.string' => 'Keterangan bansos harus berupa karakter.',
      'jumlah.required' => 'Jumlah bansos wajib untuk diisi.',
      'jumlah.numeric' => 'Jumlah bansos harus berupa angka.',
      'jumlah.min' => 'Jumlah bansos tidak boleh kurang dari 0.'
    ];

    $request->validate($rules, $messages);

    Bansos::create([
      'nama_bansos' => $request->nama_bansos,
      'keterangan' => $request->keterangan,
      'jumlah' => $request->jumlah
    ]);
  }

  /**
   * @param Request $request
   * @param int $id
   * 
   * @return void
   */
  public function updateExistingBansos(Request $request, $id)
  {
    $rules = [
      'nama_bansos' => [
        'required',
        'string',
        'max:100',
        'unique:bansos,nama_bansos,' . $id . ',id_bansos'
      ],
      'keterangan' => [
        'required',
        'string'
      ],
      'jumlah' => [
        'required',
        'numeric',
        'min:0'
      ]
    ];

    $messages = [
      'nama_bansos.required' => 'Nama bansos wajib untuk diisi.',
      'nama_bansos.string' => 'Nama bansos harus berupa karakter.',
      'nama_bansos.max' => 'Maksimal nama bansos adalah 100 karakter.',
      'nama_bansos.unique' => 'Nama bansos sudah dipakai.',
      'keterangan.required' => 'Keterangan bansos harus diisi.',
      'keterangan.string' => 'Keterangan bansos harus berupa karakter.',
      'jumlah.required' => 'Jumlah bansos wajib untuk diisi.',
      'jumlah.numeric' => 'Jumlah bansos harus berupa angka.',
      'jumlah.min' => 'Jumlah bansos tidak boleh kurang dari 0.'
    ];

    $request->validate($rules, $messages);

    Bansos::find($id)->update([
      'nama_bansos' => $request->nama_bansos,
      'keterangan' => $request->keterangan,
      'jumlah' => $request->jumlah
    ]);
  }

  /**
   * @param int $id
   * 
   * @return void
   */
  public function deleteExistingBansos($id)
  {
    Bansos::find($id)->delete();
  }

  /**
   * @return Collection
   */
  public function getPenerimaBansos()
  {
    return PenerimaBansos::with(['bansos', 'warga'])->get();
  }

  /**
   * @return Collection
   */
  public function getKandidatPenerimaBansos()
  {
    return Keluarga::select('no_kk')
      ->with('kepala_keluarga')
      ->get();
  }

  public function getKandidatPenerimaBansosByRt(string $rt)
  {
    return Keluarga::select('no_kk')
      ->where('rt', $rt)
      ->with('kepala_keluarga')
      ->get();
  }

  /**
   * @param string $nik
   * @param int $idBansos
   * 
   * @return PenerimaBansos
   */
  public function getPenerimaBansosById($nik, $idBansos)
  {
    return PenerimaBansos::with(['bansos', 'warga'])
      ->where('nik', $nik)
      ->where('id_bansos', $idBansos)
      ->first();
  }

  /**
   * @param Request $request
   * 
   * @return object | void
   */
  public function addPenerimaBansos($request)
  {
    $request->validate([
      'nik' => ['required'],
      'id_bansos' => ['required', 'integer'],
      'tanggal_penerimaan' => ['required', 'date']
    ]);

    $nik = Crypt::decrypt($request->nik);

    Validator::make(
      data: [
        'nik' => $nik,
      ],
      rules: [
        'nik' => 'exists:warga,nik'
      ],
      messages: [
        'nik.exists' => 'Nomor Induk Kependudukan tidak ada.'
      ]
    );

    $bansos = Bansos::find($request->id_bansos);
    $penerimaBansos = PenerimaBansos::where([
      'id_bansos' => $request->id_bansos,
    ])->count();

    if (($bansos->jumlah - ($penerimaBansos + 1)) < 0) {
      return (object) [
        'success' => false,
        'error' => 'Penerima bansos melebihi jumlah bansos, Harap hapus salah satu penerima sebelumnya!.'
      ];
    }

    $penerimaBansos = PenerimaBansos::where([
      'nik' => $nik,
      'id_bansos' => $request->id_bansos
    ])->first();

    if (!is_null($penerimaBansos)) {
      return (object) [
        'success' => false,
        'error' => 'Penerima sudah menerima bansos tersebut.'
      ];
    }

    PenerimaBansos::create([
      'nik' => $nik,
      'id_bansos' => $request->id_bansos,
      'tanggal_penerimaan' => $request->tanggal_penerimaan
    ]);

    return (object) [
      'success' => true,
    ];
  }

  /**
   * @param Request $request
   * @param string $nik
   * @param int $idBansos
   * 
   * @return void
   */
  public function updatePenerimaBansos($request, $nik, $idBansos)
  {
    $rules = [
      'nik' => [
        'required',
      ],
      'id_bansos' => [
        'required',
        'integer'
      ],
      'tanggal_penerimaan' => [
        'required',
        'date'
      ]
    ];

    $messages = [
      'nik.required' => 'NIK wajib untuk diisi.',
      'id_bansos.required' => 'ID Bansos wajib untuk diisi.',
      'id_bansos.integer' => 'ID Bansos harus berupa angka.',
      'tanggal_penerimaan.required' => 'Tanggal penerimaan wajib untuk diisi.',
      'tanggal_penerimaan.date' => 'Tanggal penerimaan harus berupa tanggal yang valid.'
    ];

    $request->validate($rules, $messages);

    $update_nik = Crypt::decrypt($request->nik);

    PenerimaBansos::where('id_bansos', $idBansos)->where('nik', $nik)->update([
      'nik' => $update_nik,
      'id_bansos' => $request->id_bansos,
      'tanggal_penerimaan' => $request->tanggal_penerimaan
    ]);
  }

  /**
   * @param string $nik
   * @param int $idBansos
   * 
   * @return void
   */
  public function deletePenerimaBansos($nik, $idBansos)
  {
    PenerimaBansos::where('nik', $nik)->where('id_bansos', $idBansos)->delete();
  }
}
