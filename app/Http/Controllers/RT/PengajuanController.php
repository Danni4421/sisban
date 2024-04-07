<?php

namespace App\Http\Controllers\RT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function incoming()
    {
        return view('rt.pages.pengajuan.incoming_data');
    }

    public function approved()
    {
        return view('rt.pages.pengajuan.approved_data');
    }
}
