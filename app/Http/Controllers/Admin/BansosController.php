<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BansosController extends Controller
{
    public function types() 
    {
        return view('admin.pages.bansos.types.index');
    }

    public function recipients()
    {
        return view('admin.pages.bansos.recipient.index');
    }
}
