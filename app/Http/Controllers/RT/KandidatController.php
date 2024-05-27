<?php

namespace App\Http\Controllers\RT;

use App\DataTables\RT\KandidatDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view('rt.pages.candidate.create');
    }
}
