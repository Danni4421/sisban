<?php

namespace App\Http\Controllers\RT;

use App\Livewire\Admin\Charts\LineChart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Livewire\Admin\Charts\PieChart;
use App\Models\Bansos;
use App\Models\PenerimaBansos;
use App\Models\Pengajuan;
use App\Models\Warga;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $rt = substr(Auth::user()->pengurus->jabatan, 2);
        $acceptantPieChart = $this->__getAcceptantPieChart(rt: $rt);
        $recipientPieChart = $this->__getRecipientPieChart(rt: $rt);
        $pengajuanLineChart = $this->__getPengajuanTimeSeries(rt: $rt);
        $latestPengajuan = $this->__getLatestPengajuan(rt: $rt);
        $cards = $this->__getCards(rt: $rt);

        return view('rt.pages.dashboard.index')
            ->with('acceptantPieChart', $acceptantPieChart)
            ->with('recipientPieChart', $recipientPieChart)
            ->with('pengajuanLineChart', $pengajuanLineChart)
            ->with('latestPengajuan', $latestPengajuan)
            ->with('cards', $cards);
    }

    private function __getCards(string $rt)
    {
        $jumlahPengajuan = Pengajuan::whereHas('keluarga', function ($query) use ($rt) {
            $query->where('rt', $rt);
        })->count();

        $jumlahWarga = Warga::whereHas('keluarga', function ($query) use ($rt) {
            $query->where('rt', $rt);
        })->count();

        $jumlahPenerimaBansos = PenerimaBansos::whereHas('warga.keluarga', function ($query) use ($rt) {
            $query->where('rt', $rt);
        })->count();

        $jumlahBansos = Bansos::all()->count();
        
        return [
            [
                'label' => 'Jumlah Warga',
                'color' => 'danger', 
                'icon' => 'fa-solid fa-users', 
                'data' => $jumlahWarga,
                'href' => route('rt.keluarga')
            ],
            [
                'label' => 'Jumlah Pengajuan',
                'color' => 'success',
                'icon' => 'fa-solid fa-envelope',
                'data' => $jumlahPengajuan,
                'href' => route('rt.pengajuan.incoming'),
            ],
            [
                'label' => 'Jumlah Penerima Bansos',
                'color' => 'warning',
                'icon' => 'fa-solid fa-box-open',
                'data' => $jumlahPenerimaBansos,
                'href' => route('rt.bansos'),
            ],
            [
                'label' => 'Jumlah Bansos',
                'color' => 'secondary',
                'icon' => 'fa-solid fa-boxes-stacked',
                'data' => $jumlahBansos,
                'href' => route('rt.bansos')
            ]
        ];
     }

    private function __getLatestPengajuan($rt)
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

    private function __getAcceptantPieChart(string $rt)
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

    private function __getRecipientPieChart(string $rt)
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

    private function __getPengajuanTimeSeries(string $rt)
    {
        $month_amount = 12;
        $dataset = [];

        for ($i = 0; $i < $month_amount; $i++) {
            $dataset[] = Pengajuan::whereYear('created_at', now()->year)
                ->whereMonth('created_at', $i + 1)
                ->whereHas('keluarga', function ($query) use ($rt) {
                    $query->where('rt', $rt);
                })
                ->count('created_at');
        }

        $lineChart = app()->make(LineChart::class, [
            'title' => 'Jumlah Pengajuan RT' . $rt,
            'id' => 'pengajuan_series',
        ]);

        $lineChart->setLabels(
            labels: [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ]
        );

        $lineChart->setDataset(
            datasets: [
                [
                    'label' => 'Pengajuan',
                    'data' => $dataset,
                ]
            ]
        );

        return $lineChart;
    }
}
