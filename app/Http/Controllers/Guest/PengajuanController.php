<?php

namespace App\Http\Controllers\Guest;

use App\Traits\Guest\ManageFormPengajuan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    use ManageFormPengajuan;

    public function main()
    {
        return view('guest.pengajuan.index');
    }

    public function save(Request $request, int $formIndex)
    {
        if ($formIndex) {
            
        }
    }
}
