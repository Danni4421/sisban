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
  public function createNewBansos($request)
  {
    $request->validate([
      'nama_bansos' => ['required', 'string', 'max:100', 'unique:bansos,nama_bansos'],
      'keterangan' => ['required', 'string'],
      'jumlah' => ['required', 'numeric', 'min:0']
    ]);

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
  public function updateExistingBansos($request, $id)
  {
    $request->validate([
      'nama_bansos' => ['required', 'string', 'max:100', 'unique:bansos,nama_bansos,' . $id . ',id_bansos'],
      'keterangan' => ['required', 'string'],
      'jumlah' => ['required', 'numeric', 'min:0']
    ]);

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
    $request->validate([
      'nik' => ['required'],
      'id_bansos' => ['required', 'integer'],
      'tanggal_penerimaan' => ['required', 'date']
    ]);

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
