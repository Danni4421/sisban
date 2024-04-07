<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function incoming()
    {
        return view('rw.pages.pengajuan.incoming_data');
    }

    public function approved()
    {
        return view('rw.pages.pengajuan.approved_data');
    }
}
