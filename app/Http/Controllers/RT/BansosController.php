<?php

namespace App\Http\Controllers\RT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BansosController extends Controller
{
    public function types()
    {
        return view('rt.pages.bansos.type');
    }

    public function recipients()
    {
        return view('rt.pages.bansos.recipient');
    }
}
