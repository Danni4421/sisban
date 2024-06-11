<?php

namespace App\Http\Controllers\RW\Bansos;

use App\DataTables\RW\Bansos\RecipientDataTable;
use App\Http\Controllers\Controller;
use App\Models\Bansos;
use App\Models\Keluarga;
use App\Models\PenerimaBansos;
use App\Traits\ManageBansos;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RecipientController extends Controller
{
    use ManageBansos;

    public ?RecipientDataTable $dataTable;

    public function __construct()
    {
        $this->dataTable = app()->make(RecipientDataTable::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->dataTable->render("rw.pages.bansos.recipient.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bansos = Bansos::all();
        $kandidatPenerima = $this->getKandidatPenerimaBansos();

        return view('rw.pages.bansos.recipient.create')
            ->with('bansos', $bansos)
            ->with('members', $kandidatPenerima);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = $this->addPenerimaBansos($request);

        if (!$response->success) {
            return redirect()->back()->with('error', $response->error);
        }

        return redirect('rw/bansos/penerima');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penerimaBansos = $this->getPenerimaBansos();
        return $penerimaBansos;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id_bansos, string $nik)
    {
        $nik = Crypt::decrypt($nik);
        $bansos = Bansos::all();
        $kandidatPenerima = $this->getKandidatPenerimaBansos();

        $recipient = $this->getPenerimaBansosById(nik: $nik, idBansos: $id_bansos);

        if (is_null($recipient)) {
            abort(404);
        }

        return view('rw.pages.bansos.recipient.edit')
            ->with('recipient', $recipient)
            ->with('bansos', $bansos)
            ->with('candidates', $kandidatPenerima);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id_bansos, string $nik)
    {
        $nik = Crypt::decrypt($nik);

        $this->updatePenerimaBansos(request: $request, nik: $nik, idBansos: $id_bansos);
        return redirect('rw/bansos/penerima');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id_bansos, string $nik)
    {
        $nik = Crypt::decrypt($nik);
        $this->deletePenerimaBansos(nik: $nik, idBansos: $id_bansos);
    }
}
