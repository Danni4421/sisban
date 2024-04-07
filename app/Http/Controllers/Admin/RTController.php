<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RTController extends Controller
{
    public function index()
    {
        return view('admin.pages.rt.index');
    }
}
