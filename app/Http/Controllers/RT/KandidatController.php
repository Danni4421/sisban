<?php

namespace App\Http\Controllers\RT;

use App\DataTables\RT\KandidatDataTable;
use App\Http\Controllers\Controller;
use App\Models\Keluarga;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KandidatController extends Controller
{
    public ?KandidatDataTable $dataTable;

    public function __construct()
    {
        $this->dataTable = app()->make(KandidatDataTable::class);
    }

    public function index()
    {
        return $this->dataTable->render('rt.pages.candidate.index');
    }

    public function create()
    {
        $kandidat = Keluarga::with('kepala_keluarga')
            ->where([
                'is_kandidat' => false, 
                'rt' => substr(Auth::user()->pengurus->jabatan, 2)
            ])
            ->get();

        return view('rt.pages.candidate.create')->with('kandidat', $kandidat);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kandidat' => 'required|exists:keluarga,no_kk'
        ]);

        $keluarga = Keluarga:: where(['no_kk' => $request->kandidat])->first();

        if (!is_null($keluarga)) {
            $keluarga->update([
                'is_kandidat' => 1
            ]);
        }

        $pengajuan = Pengajuan::where(['no_kk' => $request->kandidat])->first();

        if (!is_null($pengajuan) && $pengajuan->status_pengajuan != "diterima") {
            $pengajuan->update([
                'status_pengajuan' => 'diterima'
            ]);
        }

        return redirect()->route('rt.kandidat');
    }
}
