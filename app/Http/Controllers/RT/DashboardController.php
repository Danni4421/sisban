<?php

namespace App\Http\Controllers\RT;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Livewire\Admin\Charts\PieChart;
use App\Models\PenerimaBansos;
use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $rt = substr(Auth::user()->pengurus->jabatan, 2);
        $acceptantPieChart = $this->__getAcceptantPieChart(rt: $rt);
        $recipientPieChart = $this->__getRecipientPieChart(rt: $rt);
        $latestPengajuan = $this->__getLatestPengajuan(rt: $rt);

        return view('rt.pages.dashboard.index')
            ->with('acceptantPieChart', $acceptantPieChart)
            ->with('recipientPieChart', $recipientPieChart)
            ->with('latestPengajuan', $latestPengajuan);
    }

    public function __getLatestPengajuan($rt)
    {
        return Pengajuan::leftJoin('keluarga as k', 'k.no_kk', '=', 'pengajuan.no_kk')
            ->leftJoin('warga as w', 'w.no_kk', '=', 'k.no_kk')
            ->where('k.rt', $rt)
            ->where('w.level', 'kepala_keluarga')
            ->where('status_pengajuan', 'proses')
            ->orderBy('pengajuan.created_at', 'desc')
            ->select('w.nama', 'w.nik', 'w.no_hp', 'pengajuan.created_at')
            ->get();

    }

    public function __getAcceptantPieChart(string $rt)
    {
        $acceptantPerRt = array_fill(0, 7, 0);
        $listRt = ['RT025', 'RT026', 'RT027', 'RT028', 'RT029', 'RT030', 'RT031'];
        $acceptantAmountByRt = Pengajuan::getAcceptantAmountPerRt();

        foreach ($acceptantAmountByRt as $acceptant) {
            $index = array_search("RT" . $acceptant->rt, $listRt);
            $acceptantPerRt[$index] = $acceptant->total;
        }

        $pieChart = app()->make(PieChart::class, [
            'title' => 'Persentase Penerimaan Pengajuan RT' . $rt . ' dari RT lain',
            'id' => 'acceptant'
        ]);

        $pieChart->setLabels(
            labels: $listRt
        );

        $pieChart->setDataset(
            datasets: [
                [
                    'label' => 'data',
                    'data' => $acceptantPerRt
                ],
            ]
        );

        return $pieChart;
    }

    public function __getRecipientPieChart(string $rt)
    {
        $recipientAmountByRt = PenerimaBansos::getRecipientAmountByRt(rt: $rt);
        $recipientAmount = PenerimaBansos::getRecipientAmount();

        $pieChart = app()->make(PieChart::class, [
            'title' => 'Persentase Penerima Bansos RT' . $rt,
            'id' => 'bansos_recipient',
        ]);

        $pieChart->setLabels(
            labels: [
                'Penerima Bansos RT' . $rt,
                'Penerima dari RT lain',
            ]
        );

        $pieChart->setDataset(
            datasets: [
                [
                    'label' => 'Penerima Bansos',
                    'data' => [
                        $recipientAmountByRt,
                        $recipientAmount - $recipientAmountByRt
                    ]
                ]
            ]
        );

        return $pieChart;
    }
}
