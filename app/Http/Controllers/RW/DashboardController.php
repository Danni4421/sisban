<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use App\Livewire\Admin\Charts\BarChart;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public $CHART_COLOR = [];
    public $BORDER_CHART_COLOR = [];

    public $RT = [
        'RT025', 'RT026', 'RT027', 'RT028', 'RT029', 'RT030', 'RT031'
    ];

    public function __construct()
    {
        $this->CHART_COLOR = (object) [
            "RED" => "rgba(239, 107, 107, 0.5)",
            "BLUE" => "rgba(107, 152, 239, 0.5)",
            "GREEN" => "rgba(107, 239, 223, 0.5)"
        ];

        $this->BORDER_CHART_COLOR = (object) [
            "RED" => "rgba(239, 107, 107, 1)",
            "BLUE" => "rgba(107, 152, 239, 1)",
            "GREEN" => "rgba(107, 239, 223, 1)"
        ];
    }

    public function index()
    {
        return view('rw.pages.dashboard.index')
            ->with('barChart', $this->__getPengajuanBarChart())
            ->with('cards', $this->__getPengajuanInformation());
    }

    public function __getPengajuanInformation()
    {

        $incomingDataAmount = Pengajuan::all()->count();
        $acceptedDataAmount = Pengajuan::where('status_pengajuan', 'diterima')->count();
        $sendtedDataAmount = Pengajuan::where('is_printed', 1)->count();

        return (object) [
            'rt' => (object) [
                'title' => 'Jumlah RT',
                'backgroundColor' => 'primary',
                'icon' => 'bxs-user',
                'data' => 7
            ],
            'incomingData' => (object) [
                'title' => 'Data Masuk',
                'backgroundColor' => 'danger',
                'icon' => 'bx-book-content',
                'data' => $incomingDataAmount
            ],
            'acceptedData' => (object) [
                'title' => 'Data Disetujui',
                'backgroundColor' => 'success',
                'icon' => 'bx-user-pin',
                'data' => $acceptedDataAmount
            ],
            'sendtedData' => (object) [
                'title' => 'Data Diajukan',
                'backgroundColor' => 'warning',
                'icon' => 'bx-file',
                'data' => $sendtedDataAmount
            ]
        ];
    }

    public function __getPengajuanBarChart()
    {
        $incomingData = Pengajuan::getIncomingDataAmount();
        $acceptedData = Pengajuan::getAllAcceptantAmount();
        $sentedData = Pengajuan::getAllSentedDataAmount();
        
        $barChartData = array_fill(0, 3, array_fill(0, 7, 0));

        foreach ($incomingData as $data) {
            $index = array_search("RT" . $data->rt, $this->RT);
            $barChartData[0][$index] = $data->total;
        }

        foreach ($acceptedData as $data) {
            $index = array_search("RT" . $data->rt, $this->RT);
            $barChartData[1][$index] = $data->total;
        }

        foreach ($sentedData as $data) {
            $index = array_search("RT" . $data->rt, $this->RT);
            $barChartData[2][$index] = $data->total;
        }
        
        $barChart = app()->make(BarChart::class);

        $barChart->setLabels(labels: $this->RT);

        $barChart->setDataset(
            datasets: [
                [
                    'label' => 'Data Masuk',
                    'data' => $barChartData[0],
                    'backgroundColor' => $this->CHART_COLOR->RED,
                    'borderColor' => $this->BORDER_CHART_COLOR->RED,
                    'borderRadius' => 10,
                    'borderWidth' => 2
                ],
                [
                    'label' => 'Data Disetujui',
                    'data' => $barChartData[1],
                    'backgroundColor' => $this->CHART_COLOR->BLUE,
                    'borderColor' => $this->BORDER_CHART_COLOR->BLUE,
                    'borderRadius' => 10,
                    'borderWidth' => 2
                ],
                [
                    'label' => 'Data Diajukan',
                    'data' => $barChartData[2],
                    'backgroundColor' => $this->CHART_COLOR->GREEN,
                    'borderColor' => $this->BORDER_CHART_COLOR->GREEN,
                    'borderRadius' => 10,
                    'borderWidth' => 2
                ]
            ]
        );

        return $barChart;
    }
}
