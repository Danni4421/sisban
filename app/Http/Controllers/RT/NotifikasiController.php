<?php

namespace App\Http\Controllers\RT;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotifikasiController extends Controller
{
    public function index(){
        $rt = substr(Auth::user()->pengurus->jabatan, 2);

        $aplicants = Pengajuan::whereHas('keluarga', function ($query) use ($rt) {
            $query->where('rt', $rt);
        })->with(['keluarga' => function ($query) use ($rt) {
            $query->where('rt', $rt);
        }])->with('notification')
        ->get();
        
        return view('rt.pages.notification')
            ->with('aplicants', $aplicants);
    }
}
