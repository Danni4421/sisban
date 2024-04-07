<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('rw.pages.dashboard.index');
    }
}
