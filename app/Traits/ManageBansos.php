<?php

namespace App\Traits;

use App\Models\Bansos;
use App\Models\Keluarga;
use App\Models\PenerimaBansos;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

trait ManageBansos {

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
    ]);

    Bansos::create([
      'nama_bansos' => $request->nama_bansos,
      'keterangan' => $request->keterangan,
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
    ]);

    Bansos::find($id)->update([
      'nama_bansos' => $request->nama_bansos,
      'keterangan' => $request->keterangan,
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
        ->with(['anggota_keluarga' => function ($query) {
            $query->where('level', 'kepala_keluarga');
        }]) 
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
   * @return void
   */
  public function addPenerimaBansos($request)
  {
    $request->validate([
      'nik' => ['required', 'string', 'size:16'],
      'id_bansos' => ['required', 'integer'],
      'tanggal_penerimaan' => ['required', 'date']
    ]);

    PenerimaBansos::create([
      'nik' => $request->nik,
      'id_bansos' => $request->id_bansos,
      'tanggal_penerimaan' => $request->tanggal_penerimaan
    ]);
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
      'nik' => ['required', 'string', 'size:16'],
      'id_bansos' => ['required', 'integer'],
      'tanggal_penerimaan' => ['required', 'date']
    ]);

    PenerimaBansos::where('id_bansos', $idBansos)->where('nik', $nik)->update([
      'nik' => $request->nik,
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