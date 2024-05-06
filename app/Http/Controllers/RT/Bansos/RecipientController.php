<?php

namespace App\Http\Controllers\RT\Bansos;

use App\Http\Controllers\Controller;
use App\Models\Bansos;
use App\Traits\ManageBansos;
use Illuminate\Http\Request;

class RecipientController extends Controller
{
    use ManageBansos;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipients = $this->getPenerimaBansos();
        return view('rt.pages.bansos.recipient.index')->with('recipients', $recipients);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bansos = Bansos::all();
        $kandidatPenerima = $this->getKandidatPenerimaBansos();

        return view('rt.pages.bansos.recipient.create')
            ->with('bansos', $bansos)
            ->with('members', $kandidatPenerima);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->addPenerimaBansos($request);
        return redirect('rt/bansos/penerima');
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
    public function edit_recipient(int $id_bansos, string $nik)
    {
        $bansos = Bansos::all();
        $kandidatPenerima = $this->getKandidatPenerimaBansos();

        $recipient = $this->getPenerimaBansosById(nik: $nik, idBansos: $id_bansos);
        return view('rt.pages.bansos.recipient.edit')
            ->with('recipient', $recipient)
            ->with('bansos', $bansos)
            ->with('candidates', $kandidatPenerima);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_recipient(Request $request, int $id_bansos, string $nik)
    {
        $this->updatePenerimaBansos(request: $request, nik: $nik, idBansos: $id_bansos);
        return redirect('rt/bansos/penerima');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_recipient(int $id_bansos, string $nik)
    {
        $this->deletePenerimaBansos(nik: $nik, idBansos: $id_bansos);
        return redirect('rt/bansos/penerima');
    }
}
