<?php

namespace App\Http\Controllers\RT\Bansos;

use App\DataTables\RT\Bansos\RecipientDataTable;
use App\Http\Controllers\Controller;
use App\Models\Bansos;
use App\Traits\ManageBansos;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RecipientController extends Controller
{
    use ManageBansos;

    public ?RecipientDataTable $dataTable;

    public function __construct() {
        $this->dataTable = app()->make(RecipientDataTable::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->dataTable->render("rt.pages.bansos.recipient.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bansos = Bansos::all();

        $rt = substr(auth()->user()->pengurus->jabatan, 2);
        $kandidatPenerima = $this->getKandidatPenerimaBansosByRt(rt: $rt);

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
    public function show(string $nik, int $id_bansos)
    {
        $penerimaBansos = $this->getPenerimaBansosById(nik: $nik, idBansos: $id_bansos);

        if ($penerimaBansos) {

            return response()->json([
                'penerimaBansos' => $penerimaBansos ,
            ]);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function delete_recipient(int $id_bansos, string $nik)
    {
        $this->deletePenerimaBansos(nik: $nik, idBansos: $id_bansos);
    }
}
