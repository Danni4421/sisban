<?php

namespace App\Http\Controllers\RT\Bansos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TopsisController extends Controller
{
    public function main(int $id_bansos)
    {
        $topsis_calculation = Http::post(env('DSS_URL') . '/topsis', [
            'bansos' => $id_bansos,
        ]);

        $calculation_result = json_decode($topsis_calculation)->data;

        if (empty($calculation_result->evaluation_matrix)) {
            abort(404);
        }

        // Data alternatif
        $alternatif = $calculation_result->evaluation_matrix;

        // Kriteria
        $kriteria = [
            ['name' => 'Kondisi Ekonomi', 'type' => 'Benefit', 'key' => 'kondisi_ekonomi'],
            ['name' => 'Tanggungan', 'type' => 'Cost', 'key' => 'tanggungan'],
            ['name' => 'Hutang', 'type' => 'Benefit', 'key' => 'hutang'],
            ['name' => 'Aset', 'type' => 'Cost', 'aset', 'key' => 'aset'], 
            ['name' => 'Biaya Listrik', 'type' => 'Benefit', 'biaya_listrik', 'key' => 'biaya_listrik'],
            ['name' => 'Biaya Air', 'type' => 'Benefit', 'biaya_air', 'key' => 'biaya_air'],
        ];

        // Bobot kriteria
        $bobot_kriteria = [0.25, 0.22, 0.15, 0.15, 0.135, 0.095];

        return view('rt.pages.bansos.topsis.index', [
            'id_bansos' => $id_bansos,
            'alternatives' => $alternatif,
            'kriteria' => $kriteria,
            'bobot_kriteria' => $bobot_kriteria,
            'normalization' => $calculation_result->normalization,
            'bobot_normalisasi' => $calculation_result->weighting,
            'solusi_ideal_positif' => last(array_filter(
                $this->map_ideal_variable($calculation_result->best_worst_alternative), fn($e) => $e['status'] == 'best')),
            'solusi_ideal_negatif' => last(array_filter(
                $this->map_ideal_variable($calculation_result->best_worst_alternative), fn($e) => $e['status'] == 'worst')),
            'euclidean_distance' => $calculation_result->euclidean,
        ]);
    }

    private function map_ideal_variable($ideal_alternative) {
        return array_map(
            function ($solution) {
                return [
                    'kondisi_ekonomi' => $solution->bw_kondisi_ekonomi,
                    'tanggungan' => $solution->bw_tanggungan,
                    'hutang' => $solution->bw_hutang,
                    'aset' => $solution->bw_aset,
                    'biaya_listrik' => $solution->bw_biaya_listrik,
                    'biaya_air' => $solution->bw_biaya_air,
                    'status' => $solution->status
                ];
            },
            $ideal_alternative
        );
    }
}
