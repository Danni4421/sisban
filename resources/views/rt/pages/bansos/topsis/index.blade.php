@extends('layouts.app')

@section('title', 'Perhitungan Topsis')

@section('content_header')
    <header>
        <h1>Perhitungan TOPSIS</h1>
    </header>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Daftar Data Kriteria -->
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
                            @foreach ($kriteria as $index => $k)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>C{{ $index + 1 }}</td>
                                    <td>{{ $k['nama'] }}</td>
                                    <td>{{ $bobot_kriteria['kriteria_' . ($index + 1)] }}</td>
                                    <td>{{ $k['tipe'] == 1 ? 'Benefit' : 'Cost' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Daftar Data Kriteria -->
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
                            @foreach ($alternatif as $index => $k)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>A{{ $index + 1 }}</td>
                                    <td>{{ $k['nama'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Matriks Keputusan -->
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
                                    <th>{{ $k['nama'] }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatif as $index => $alt)
                                <tr>
                                    <td>{{ $alt['nama'] }}</td>
                                    @foreach ($kriteria as $key => $k)
                                        <td>{{ $alt['kriteria_' . ($key + 1)] }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Matriks Normalisasi -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="bg-info text-light p-2 mb-2">
                    <h5 class="text-center">Matriks Normalisasi</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                @foreach ($kriteria as $k)
                                    <th>{{ $k['nama'] }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($normalisasi as $alt)
                                <tr>
                                    <td>{{ $alt['nama'] }}</td>
                                    @foreach ($alt['normalisasi'] as $nilai)
                                        <td>{{ number_format($nilai, 4) }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Bobot Normalisasi -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="bg-info text-light p-2 mb-2">
                    <h5 class="text-center">Bobot Normalisasi</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                @foreach ($kriteria as $k)
                                    <th>{{ $k['nama'] }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bobot_normalisasi as $alt)
                                <tr>
                                    <td>{{ $alt['nama'] }}</td>
                                    @foreach ($alt['bobot_normalisasi'] as $nilai)
                                        <td>{{ number_format($nilai, 4) }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Solusi Ideal Positif dan Negatif -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="bg-info text-light p-2 mb-2">
                    <h5 class="text-center">Solusi Ideal Positif (A+)</h5>
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
                            @foreach ($solusi_ideal_positif as $index => $nilai)
                                <tr>
                                    <td>{{ $kriteria[$index]['nama'] }}</td>
                                    <td>{{ number_format($nilai, 4) }}</td>
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
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($solusi_ideal_negatif as $index => $nilai)
                                <tr>
                                    <td>{{ $kriteria[$index]['nama'] }}</td>
                                    <td>{{ number_format($nilai, 4) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Jarak Euclidean -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="bg-info text-light p-2 mb-2">
                    <h5 class="text-center">Jarak Euclidean</h5>
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
                            @foreach ($jarak_euclidean as $alt)
                                <tr>
                                    <td>{{ $alt['nama'] }}</td>
                                    <td>{{ number_format($alt['jarak_d_positif'], 4) }}</td>
                                    <td>{{ number_format($alt['jarak_d_negatif'], 4) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="bg-info text-light p-2 mb-2">
                    <h5 class="text-center">Nilai Preferensi</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>                                        
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Nilai Preferensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nilai_preferensi as $alt)
                                <tr>
                                    <td>{{ $alt['kode'] }}</td>
                                    <td>{{ $alt['nama'] }}</td>
                                    <td>{{ number_format($alt['nilai_preferensi'], 4) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
       
