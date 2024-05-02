<?php

namespace App\Http\Controllers\Guest\Bansos;

use App\DataTables\Guest\AplicantsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class AplicantController extends Controller
{
    public ?AplicantsDataTable $dataTable;

    public function __construct()
    {
        $this->dataTable = resolve(AplicantsDataTable::class);
    }

    public function index()
    {
        return $this->dataTable->render("guest.bansos.aplicant.index");
    }
}
