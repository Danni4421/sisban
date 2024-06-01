<?php

namespace App\Http\Controllers\RT\Bansos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TopsisController extends Controller
{
    public function index()
    {
        // Data alternatif dan kriteria (contoh)
        $alternatif = [
            ['kode' => '150001', 'nama' => 'Alternatif 1', 'kriteria_1' => 5, 'kriteria_2' => 2, 'kriteria_3' => 1, 'kriteria_4' => 4, 'kriteria_5' => 1],
            ['kode' => '150002', 'nama' => 'Alternatif 2', 'kriteria_1' => 5, 'kriteria_2' => 1, 'kriteria_3' => 1, 'kriteria_4' => 3, 'kriteria_5' => 1],
            ['kode' => '150003', 'nama' => 'Alternatif 3', 'kriteria_1' => 5, 'kriteria_2' => 3, 'kriteria_3' => 1, 'kriteria_4' => 4, 'kriteria_5' => 1],
        ];

        // Kriteria (0: cost, 1: benefit)
        $kriteria = [
            ['nama' => 'Kriteria 1', 'tipe' => 1], // Benefit
            ['nama' => 'Kriteria 2', 'tipe' => 0], // Cost
            ['nama' => 'Kriteria 3', 'tipe' => 1], // Benefit
            ['nama' => 'Kriteria 4', 'tipe' => 0], // Cost
            ['nama' => 'Kriteria 5', 'tipe' => 1], // Benefit
        ];

        // Bobot kriteria (contoh)
        $bobot_kriteria = [
            'kriteria_1' => 0.2,
            'kriteria_2' => 0.1,
            'kriteria_3' => 0.3,
            'kriteria_4' => 0.2,
            'kriteria_5' => 0.2,
        ];

        // Hitung TOPSIS
        $hasil_topsis = $this->hitungTOPSIS($alternatif, $kriteria, $bobot_kriteria);

        // Kirim data ke view
        return view('rt.pages.bansos.topsis.index', [
            'alternatif' => $alternatif,
            'kriteria' => $kriteria,
            'bobot_kriteria' => $bobot_kriteria,
            'normalisasi' => $hasil_topsis['normalisasi'],
            'bobot_normalisasi' => $hasil_topsis['bobot_normalisasi'],
            'solusi_ideal_positif' => $hasil_topsis['solusi_ideal_positif'],
            'solusi_ideal_negatif' => $hasil_topsis['solusi_ideal_negatif'],
            'jarak_euclidean' => $hasil_topsis['jarak_euclidean'],
            'nilai_preferensi' => $hasil_topsis['nilai_preferensi'],
        ]);
    }

    private function hitungTOPSIS($alternatif, $kriteria, $bobot_kriteria)
    {
        // 1. Normalisasi Matriks
        $normalisasi = [];
        foreach ($alternatif as $index => $alt) {
            $normalisasi[$index] = ['kode' => $alt['kode'], 'nama' => $alt['nama'], 'normalisasi' => []];
            foreach ($kriteria as $k_index => $k) {
                $nilai_maks = max(array_column($alternatif, 'kriteria_'. ($k_index + 1)));
                $nilai_min = min(array_column($alternatif, 'kriteria_'. ($k_index + 1)));

                if ($k['tipe'] == 1) { // Benefit
                    $nilai_norm = $alt['kriteria_'. ($k_index + 1)] / $nilai_maks;
                } else { // Cost
                    $nilai_norm = $nilai_min / $alt['kriteria_'. ($k_index + 1)];
                }

                $normalisasi[$index]['normalisasi'][] = $nilai_norm;
            }
        }

        // 2. Bobot Normalisasi
        $bobot_normalisasi = [];
        foreach ($normalisasi as $index => $alt) {
            $bobot_normalisasi[$index] = ['kode' => $alt['kode'], 'nama' => $alt['nama'], 'bobot_normalisasi' => []];
            foreach ($alt['normalisasi'] as $k_index => $nilai_norm) {
                $bobot_normalisasi[$index]['bobot_normalisasi'][] = $nilai_norm * $bobot_kriteria['kriteria_'.($k_index + 1)];
            }
        }

        // 3. Solusi Ideal Positif (A+) dan Negatif (A-)
        $solusi_ideal_positif = [];
        $solusi_ideal_negatif = [];
        foreach ($kriteria as $k_index => $k) {
            $nilai_bobot_kriteria = array_column($bobot_normalisasi, 'bobot_normalisasi');
            $nilai_kriteria = array_column($nilai_bobot_kriteria, $k_index);
            if ($k['tipe'] == 1) { // Benefit
                $solusi_ideal_positif[] = max($nilai_kriteria);
                $solusi_ideal_negatif[] = min($nilai_kriteria);
            } else { // Cost
                $solusi_ideal_positif[] = min($nilai_kriteria);
                $solusi_ideal_negatif[] = max($nilai_kriteria);
            }
        }

        // 4. Jarak Euclidean
        $jarak_euclidean = [];
        foreach ($bobot_normalisasi as $index => $alt) {
            $jarak_euclidean[$index] = ['kode' => $alt['kode'], 'nama' => $alt['nama'], 'jarak_d_positif' => 0, 'jarak_d_negatif' => 0];
            foreach ($alt['bobot_normalisasi'] as $k_index => $nilai_norm) {
                $jarak_euclidean[$index]['jarak_d_positif'] += pow($nilai_norm - $solusi_ideal_positif[$k_index], 2);
                $jarak_euclidean[$index]['jarak_d_negatif'] += pow($nilai_norm - $solusi_ideal_negatif[$k_index], 2);
            }
            $jarak_euclidean[$index]['jarak_d_positif'] = sqrt($jarak_euclidean[$index]['jarak_d_positif']);
            $jarak_euclidean[$index]['jarak_d_negatif'] = sqrt($jarak_euclidean[$index]['jarak_d_negatif']);
        }

        // 5. Nilai Preferensi (V)
        $nilai_preferensi = [];
        foreach ($jarak_euclidean as $index => $alt) {
            $nilai_preferensi[$index] = ['kode' => $alt['kode'], 'nama' => $alt['nama'], 'nilai_preferensi' => $alt['jarak_d_negatif'] / ($alt['jarak_d_positif'] + $alt['jarak_d_negatif'])];
        }

        // 6. Perangkingan
        usort($nilai_preferensi, function ($a, $b) {
            return $b['nilai_preferensi'] <=> $a['nilai_preferensi'];
        });

        // Kembalikan hasil
        return [
            'normalisasi' => $normalisasi,
            'bobot_normalisasi' => $bobot_normalisasi,
            'solusi_ideal_positif' => $solusi_ideal_positif,
            'solusi_ideal_negatif' => $solusi_ideal_negatif,
            'jarak_euclidean' => $jarak_euclidean,
            'nilai_preferensi' => $nilai_preferensi,
        ];
    }
}
