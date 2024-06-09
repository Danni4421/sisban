<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        $applicantsByRT = Pengajuan::join('keluarga', 'pengajuan.no_kk', '=', 'keluarga.no_kk')
            ->join('notification', 'pengajuan.no_kk', '=', 'notification.no_kk')
            ->selectRaw('keluarga.rt as rt, count(*) as jumlah')
            ->where('notification.is_readed_rw', '0') // Perhatikan penggunaan operator '=' tanpa tanda kutip ganda di '0'
            ->groupBy('keluarga.rt')
            ->get();    

        return view("rw.pages.notification")
            ->with('applicantsByRT', $applicantsByRT);
    }
}
