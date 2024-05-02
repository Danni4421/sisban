<?php

namespace App\Http\Controllers\Guest\Bansos;

use App\DataTables\Guest\RecipientDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecipientController extends Controller
{
    public ?RecipientDataTable $dataTable;

    public function __construct()
    {
        $this->dataTable = app()->make(RecipientDataTable::class);
    }

    public function index()
    {
        return $this->dataTable->render('guest.bansos.recipient.index');
    }
}
