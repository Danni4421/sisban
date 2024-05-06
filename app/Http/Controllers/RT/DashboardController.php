<?php

namespace App\Http\Controllers\RT;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengurus;

class DashboardController extends Controller
{
    public function index()
    {
        return view('rt.pages.dashboard.index');
    }
}
