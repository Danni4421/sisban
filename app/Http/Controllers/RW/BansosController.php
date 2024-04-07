<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BansosController extends Controller
{
    public function recipients()
    {
        return view('rw.pages.bansos.recipient');
    }
}
