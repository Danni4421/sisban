@extends('layouts.app')

@section('content_header')
    <h1>Perhitungan Fuzzy</h1>
    <hr>
@endsection

@section('breadcrumb')
    @livewire('admin.bread-crumb', [
      'links' => [
        ['href' => route('rt.bansos'), 'label' => 'Bantuan Sosial'],
        ['href' => route('rt.bansos.alternative', ['id_bansos' => $id_bansos]), 'label' => 'Alternatif']
      ],
      'active' => 'Hitung Fuzzy'
    ])
@endsection


@section('content')
    <div class="container-fluid p-3 rounded-lg" style="background: #fff;">
        {{-- Membership --}}
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card card-info shadow-none">
                    <div class="card-header">
                        <h3 class="card-title">Derajat Keanggotaan Penghasilan</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="chart1"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card card-info shadow-none">
                    <div class="card-header">
                        <h3 class="card-title">Derajat Keanggotaan Pengeluaran</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="chart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- Reward --}}
            <div class="col-12 col-md-6">
                <div class="card card-info shadow-none">
                    <div class="card-header">
                        <h3 class="card-title">Himpunan Output</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="chart3"></canvas>
                    </div>
                </div>
            </div>
            {{-- Alternative Detail --}}
            <div class="col-12 col-md-6">
                <div class="card card-info shadow-none">
                    <div class="card-header">
                        <h3 class="card-title">Detail Alternatif</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <img 
                                    src="{{ asset('assets/' . $warga->foto_ktp) }}" 
                                    alt="KTP"
                                    width='214.225px' 
                                    height='134.95px'
                                >
                            </div>
                            <div class="col-md-6">
                                <p class="card-text"><strong>No KTP :</strong> {{ $warga->nik }}</p>
                                <p class="card-text"><strong>Nama :</strong> {{ $warga->nama }}</p>
                                <p class="card-text"><strong>Alamat :</strong> RT {{ $warga->keluarga->rt }}</p>
                                <p class="card-text"><strong>Gaji :</strong> Rp. @currency($fuzzy_data->penghasilan)</p>
                                <p class="card-text"><strong>Pengeluaran :</strong> Rp. @currency($fuzzy_data->pengeluaran)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- Fuzzy Table --}}
                <div class="col-12">
                    <div class="card card-info shadow-none">
                        <div class="card-header">
                            <h3 class="card-title">Table Perhitungan Fuzzy</h3>
                        </div>
                        <div class="card-body px-0 overflow-auto">
                            <table class="table table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Rule</th>
                                        <th>Alpha Penghasilan</th>
                                        <th>Alpha Pengeluaran</th>
                                        <th>Alpha Predikat</th>
                                        <th>Z Hasil</th>
                                        <th>Alpha Predikat * Z</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->fuzzy as $dt)
                                        <tr>
                                            <td>{{ $dt->rule_index }}</td>
                                            <td>{{ $dt->alpha_v1 }}</td>
                                            <td>{{ $dt->alpha_v2 }}</td>
                                            <td>{{ $dt->alpha }}</td>
                                            <td>{{ $dt->z_result }}</td>
                                            <td>{{ $dt->a_pred_multiply_z_pred }}</td>
                                        </tr>
                                    @endforeach
                                    <tr class="bg-secondary">
                                        <td colspan="3">Total Alpha</td>
                                        <td><b>{{ $data->sum_alpha }}</b></td>
                                        <td>Total Z</td>
                                        <td><b>{{ $data->sum_alpha_pred_multiply_z_pred }}</b></td>
                                    </tr>
                                    <tr class="bg-secondary">
                                        <td colspan="5">Hasil</td>
                                        <td><b>{{ $data->sum_alpha_pred_multiply_z_pred/$data->sum_alpha }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('rt.bansos.alternative', ['id_bansos' => $id_bansos]) }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            <span class="ms-1">Kembali</span>
        </a>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {

            // Penghasilan Membership Chart
            const penghasilan = {
                labels: [0, 0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5, 5.5, 6, 6.5, 7],
                datasets: [{
                        label: 'Sangat Sedikit',
                        backgroundColor: 'red',
                        borderColor: 'red',
                        data: [1, 1, 0],
                        pointRadius: 0,
                    },
                    {
                        label: 'Sedikit',
                        backgroundColor: 'orange',
                        borderColor: 'orange',
                        data: [null, 0, 0.5, 1, 1, 0.666, 0.333, 0],
                        pointRadius: 0,
                    },
                    {
                        label: 'Banyak',
                        backgroundColor: 'green',
                        borderColor: 'green',
                        data: [null, null, null, null, 0, 0.333, 0.666, 1, 1, 0.666, 0.333, 0],
                        pointRadius: 0,
                    },
                    {
                        label: 'Sangat Banyak',
                        backgroundColor: 'blue',
                        borderColor: 'blue',
                        data: [null, null, null, null, null, null, null, null, 0, 0.333, 0.666, 1, 1, 1, 1],
                        pointRadius: 0,
                    }
                ]
            };

            // Pengeluaran Membership Chart
            const pengeluaran = {
                labels: [0, 0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5, 5.5, 6, 6.5, 7],
                datasets: [{
                        label: 'Sangat Sedikit',
                        backgroundColor: 'red',
                        borderColor: 'red',
                        fill: false,
                        data: [1, 1, 0],
                        pointRadius: 0,
                    },
                    {
                        label: 'Sedikit',
                        backgroundColor: 'orange',
                        borderColor: 'orange',
                        fill: false,
                        data: [null, 0, 1, 1, 0.666, 0.333, 0],
                        pointRadius: 0,
                    },
                    {
                        label: 'Banyak',
                        backgroundColor: 'green',
                        borderColor: 'green',
                        fill: false,
                        data: [null, null, null, 0, 0.333, 0.666, 1, 0.75, 0.5, 0.25, 0],
                        pointRadius: 0,
                    },
                    {
                        label: 'Sangat Banyak',
                        backgroundColor: 'blue',
                        borderColor: 'blue',
                        fill: false,
                        data: [null, null, null, null, null, null, 0, 0.25, 0.5, 0.75, 1, 1, 1, 1, 1, 1],
                        pointRadius: 0,
                    },
                ]
            };

            // Reward Output Chart
            const output = {
                labels: [0, 10, 20, 30, 40, 50, 60, 70, 75, 80, 90, 100],
                datasets: [{
                        label: 'Sangat Kurang',
                        backgroundColor: 'red',
                        borderColor: 'red',
                        data: [1, 1, 1, 0],
                        pointRadius: 0,
                    },
                    {
                        label: 'Kurang',
                        backgroundColor: 'orange',
                        borderColor: 'orange',
                        data: [null, null, 0, 1, 1, 1],
                        pointRadius: 0,
                    },
                    {
                        label: 'Mampu',
                        backgroundColor: 'green',
                        borderColor: 'green',
                        data: [null, null, null, null, null, 0, 1, 1, 1],
                        pointRadius: 0,
                    },
                    {
                        label: 'Sangat Mampu',
                        backgroundColor: 'blue',
                        borderColor: 'blue',
                        data: [null, null, null, null, null, null, null, null, 0, 1, 1, 1],
                        pointRadius: 0,
                    }
                ]
            };

            // Default options for each Line Chart
            const defaultOptions = {
                responsive: true,
                scales: {
                    x: {
                        type: 'linear',
                        position: 'bottom',
                        title: {
                            display: true,
                        }
                    },
                    y: {
                        min: 0,
                        max: 1,
                        title: {
                            display: true,
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 14
                            },
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                },
            };
            
            // Options for chart penghasilan
            const defaultConfigPenghasilan = {
                type: 'line',
                data: penghasilan,
                options: defaultOptions
            };
            
            // Option for chart pengeluaran
            const defaultConfigPengeluaran = {
                type: 'line',
                data: pengeluaran,
                options: defaultOptions
            };

            // Option for output
            const defaultConfigOutput = {
                type: 'line',
                data: output,
                options: defaultOptions
            };

            const ctx1 = document.getElementById('chart1').getContext('2d');
            new Chart(ctx1, defaultConfigPenghasilan);

            const ctx2 = document.getElementById('chart2').getContext('2d');
            new Chart(ctx2, defaultConfigPengeluaran);

            const ctx3 = document.getElementById('chart3').getContext('2d');
            new Chart(ctx3, defaultConfigOutput);
            });
        </script>
    @endpush
@endsection
