@extends('layouts.app')

@section('title', 'Perhitungan Topsis')

@section('content_header')
    <h4>Perhitungan TOPSIS</h4>
@endsection

@section('breadcrumb')
    @livewire('admin.bread-crumb', [
      'links' => [
        ['href' => route('rt.bansos'), 'label' => 'Bantuan Sosial'],
        ['href' => route('rt.bansos.alternative', ['id_bansos' => $id_bansos]), 'label' => 'Alternatif']
      ],
      'active' => 'Hitung Topsis'
    ])
@endsection

@section('content')
    <div class="container-fluid p-3 rounded-lg" style="background: #fff;">
        {{-- List of criteria --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="bg-info text-light p-2 mb-2">
                    <h5 class="text-center">Daftar Data Kriteria</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Kriteria</th>
                                <th>Nama Kriteria</th>
                                <th>Bobot</th>
                                <th>Jenis</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kriteria as $key => $criteria)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>C{{ $key + 1 }}</td>
                                    <td>{{ $criteria["name"] }}</td>
                                    <td>{{ $bobot_kriteria[$key] }}</td>
                                    <td>{{ $criteria["type"] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Aliases criteria --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="bg-info text-light p-2 mb-2">
                    <h5 class="text-center">Daftar Data Alternatif</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Alternatif</th>
                                <th>Nama Alternatif</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatives as $index => $alternative)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>A{{ $index + 1 }}</td>
                                    <td>{{ $alternative->alternative }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Evaluation Matrix --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="bg-info text-light p-2 mb-2">
                    <h5 class="text-center">Matriks Keputusan</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                @foreach ($kriteria as $k)
                                    <th>{{ $k['name'] }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatives as $index => $alternative)
                                <tr>
                                    <td>{{ $alternative->alternative }}</td>
                                    <td>{{ $alternative->kondisi_ekonomi }}</td>
                                    <td class="text-center">{{ $alternative->tanggungan }}</td>
                                    <td>Rp. @currency($alternative->hutang)</td>
                                    <td>Rp. @currency($alternative->aset)</td>
                                    <td>Rp. @currency($alternative->biaya_listrik)</td>
                                    <td>Rp. @currency($alternative->biaya_air)</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Normalized Matrix --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="bg-info text-light p-2 mb-2">
                    <h5 class="text-center">Matriks Normalisasi</h5>
                </div>
                <div>
                    <p>
                        \[
                        r_{ij} = \frac{x_{ij}}{\sqrt{\sum_{i=1}^{m} x_{ij}^{2}}}
                        \]
                    </p>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                @foreach ($kriteria as $k)
                                    <th scope="col">{{ $k['name'] }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($normalization as $norm)
                                <tr>
                                    <td scope="row">{{ $norm->alternative }}</td>
                                    <td>{{ round($norm->normalize_kondisi_ekonomi, 4) }}</td>
                                    <td>{{ round($norm->normalize_tanggungan, 4) }}</td>
                                    <td>{{ round($norm->normalize_hutang, 4) }}</td>
                                    <td>{{ round($norm->normalize_aset, 4) }}</td>
                                    <td>{{ round($norm->normalize_biaya_listrik, 4) }}</td>
                                    <td>{{ round($norm->normalize_biaya_air, 4) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
 
        {{-- Weighted Matrix --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="bg-info text-light p-2 mb-2">
                    <h5 class="text-center">Bobot Normalisasi</h5>
                </div>
                <div>
                    <p>
                        \[
                        y_{ij} = W_{i}r_{ij}
                        \]
                    </p>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                @foreach ($kriteria as $k)
                                    <th>{{ $k['name'] }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bobot_normalisasi as $weight)
                                <tr>
                                    <td>{{ $weight->alternative }}</td>
                                    <td>{{ round($weight->weighted_kondisi_ekonomi, 4) }}</td>
                                    <td>{{ round($weight->weighted_tanggungan, 4) }}</td>
                                    <td>{{ round($weight->weighted_hutang, 4) }}</td>
                                    <td>{{ round($weight->weighted_aset, 4) }}</td>
                                    <td>{{ round($weight->weighted_biaya_listrik, 4) }}</td>
                                    <td>{{ round($weight->weighted_biaya_air, 4) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Best Worst Solution --}}
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="bg-info text-light p-2 mb-2">
                    <h5 class="text-center">Solusi Ideal Positif (A+)</h5>
                </div>
                <div>
                    <p>
                        \[
                        Benefit: max(y_{ij})  
                        \]
                    </p>
                    <p>
                        \[
                        Cost: min(y_{ij})     
                        \]
                    </p>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kriteria as $kt)
                                <tr>
                                    <td>{{ $kt['name'] }}</td>
                                    <td>{{ round($solusi_ideal_positif[$kt['key']], 4) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="bg-info text-light p-2 mb-2">
                    <h5 class="text-center">Solusi Ideal Negatif (A-)</h5>
                </div>
                <div>
                    <p>
                        \[
                        Benefit: min(y_{ij})  
                        \]
                    </p>
                    <p>
                        \[
                        Cost: max(y_{ij})     
                        \]
                    </p>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kriteria as $kt)
                                <tr>
                                    <td>{{ $kt['name'] }}</td>
                                    <td>{{ round($solusi_ideal_negatif[$kt['key']], 4) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Euclidean Distance --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="bg-info text-light p-2 mb-2">
                    <h5 class="text-center">Jarak Euclidean</h5>
                </div>
                <div class="d-flex justify-content-center gap-5">
                    <p>
                        \[
                        D_{i}^{+} = \sqrt{\sum_{j=1}^{n} (y_{i}^{+} - y_{ij})^{2}}    
                        \]
                    </p>
                    <p>
                        \[
                        D_{i}^{-} = \sqrt{\sum_{j=1}^{n} (y_{ij} - y_{i}^{-})^{2}}    
                        \]
                    </p>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jarak ke A+</th>
                                <th>Jarak ke A-</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($euclidean_distance as $distance)
                                <tr>
                                    <td>{{ $distance->alternative }}</td>
                                    <td>{{ $distance->positive_distance }}</td>
                                    <td>{{ $distance->negative_distance }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Preference Value and Rank --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="bg-info text-light p-2 mb-2">
                    <h5 class="text-center">Nilai Preferensi</h5>
                </div>
                <div class="d-flex justify-content-center gap-5">
                    <p>
                        \[
                        V_{i} = \frac{D_{i}^{-}}{D_{i}^{-} + D_{i}^{+}}   
                        \]
                    </p>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>                                        
                                <th>Nama</th>
                                <th>Nilai Preferensi</th>
                                <th>Ranking</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatives as $alternative)
                                <tr>
                                    <td>{{ $alternative->alternative }}</td>
                                    <td>{{ $alternative->preference_value }}</td>
                                    <td>{{ $alternative->rank }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <a href="{{ route('rt.bansos.alternative', ['id_bansos' => $id_bansos]) }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            <span class="ms-1">Kembali</span>
        </a>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
@endpush
       
