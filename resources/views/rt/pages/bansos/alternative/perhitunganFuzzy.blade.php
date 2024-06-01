@extends('layouts.app')

@section('content_header')
    <h1>Perhitungan Fuzzy</h1>
    <hr>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Derajat Keanggotaan Rentang Gaji</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="chart1"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card card-info">
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
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Detail Penerima</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <img src="{{ asset('gambar/default-avatar.jpg') }}" alt="gambar ktp">
                            </div>
                            <div class="col-md-6">
                                <p class="card-text"><strong>No KTP :</strong> 22415124785</p>
                                <p class="card-text"><strong>Nama :</strong> Muhammad Fauzan</p>
                                <p class="card-text"><strong>Alamat :</strong> RT. 031 </p>
                                <p class="card-text"><strong>Tanggungan :</strong> 4</p>
                                <p class="card-text"><strong>Gaji :</strong> 2000000</p>
                                <p class="card-text"><strong>Pengeluaran :</strong> 100000 </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Table Perhitungan Fuzzy</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Rules</th>
                                            <th>V1</th>
                                            <th>V2</th>
                                            <th>A - Predikat</th>
                                            <th>Z Hasil</th>
                                            <th>A - pred * Z</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>p</td>
                                            <td>p</td>
                                            <td>p</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @push('scripts')
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {

                        function membershipSangatSedikit(x) {
                            if (x <= 0.5) return 1;
                            if (x <= 1.5) return (1.5 - x) / (1.5 - 0.5);
                            return 0;
                        }

                        function membershipSedikit(x) {
                            if (x <= 0.5 || x >= 3.5) return 0;
                            if (x <= 1.5) return (x - 0.5) / (1.5 - 0.5);
                            if (x <= 2) return 1;
                            if (x <= 3.5) return (3.5 - x) / (3.5 - 2);
                            return 0;
                        }

                        function membershipBanyak(x) {
                            if (x <= 2 || x >= 6.5) return 0;
                            if (x <= 3.5) return (x - 2) / (3.5 - 2);
                            if (x <= 4) return 1;
                            if (x <= 6.5) return (6.5 - x) / (6.5 - 4);
                            return 0;
                        }

                        function membershipSangatBanyak(x) {
                            if (x <= 4) return 0;
                            if (x <= 6.5) return (x - 4) / (6.5 - 4);
                            return 1;
                        }

                        // Data untuk Chart.js
                        const xValues1 = [];
                        const sangatSedikitValues1 = [];
                        const sedikitValues1 = [];
                        const banyakValues1 = [];
                        const sangatBanyakValues1 = [];

                        for (let x = 0; x <= 7; x += 0.1) {
                            xValues1.push(x.toFixed(1));
                            sangatSedikitValues1.push(membershipSangatSedikit(x).toFixed(2));
                            sedikitValues1.push(membershipSedikit(x).toFixed(2));
                            banyakValues1.push(membershipBanyak(x).toFixed(2));
                            sangatBanyakValues1.push(membershipSangatBanyak(x).toFixed(2));
                        }

                        // Data untuk Chart.js
                        const data1 = {
                            labels: xValues1,
                            datasets: [{
                                    label: 'Sangat Sedikit',
                                    borderColor: 'purple',
                                    fill: false,
                                    data: sangatSedikitValues1,
                                    pointRadius: 0,
                                },
                                {
                                    label: 'Sedikit',
                                    borderColor: 'green',
                                    fill: false,
                                    data: sedikitValues1,
                                    pointRadius: 0,
                                },
                                {
                                    label: 'Banyak',
                                    borderColor: 'orange',
                                    fill: false,
                                    data: banyakValues1,
                                    pointRadius: 0,
                                },
                                {
                                    label: 'Sangat Banyak',
                                    borderColor: 'blue',
                                    fill: false,
                                    data: sangatBanyakValues1,
                                    pointRadius: 0,
                                },
                            ]
                        };

                        const config1 = {
                            type: 'line',
                            data: data1,
                            options: {
                                responsive: true,
                                scales: {
                                    x: {
                                        type: 'linear',
                                        position: 'bottom',
                                        min: 0,
                                        max: 7,
                                        title: {
                                            display: true,
                                            text: 'X Axis'
                                        }
                                    },
                                    y: {
                                        min: 0,
                                        max: 1,
                                        title: {
                                            display: true,
                                            text: 'Y Axis'
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top',
                                    },
                                },
                            }
                        };

                        const ctx1 = document.getElementById('chart1').getContext('2d');
                        new Chart(ctx1, config1);

                        function membershipSangatSedikit2(x) {
                            if (x <= 0.5) return 1;
                            if (x <= 1) return (1 - x) / (1 - 0.5);
                            return 0;
                        }

                        function membershipSedikit2(x) {
                            if (x <= 0.5 || x >= 3) return 0;
                            if (x <= 1) return (x - 0.5) / (1 - 0.5);
                            if (x <= 1.5) return 1;
                            if (x <= 3) return (3 - x) / (3 - 1.5);
                            return 0;
                        }

                        function membershipBanyak2(x) {
                            if (x <= 1.5 || x >= 5) return 0;
                            if (x <= 3) return (x - 1.5) / (3 - 1.5);
                            if (x <= 5) return (5 - x) / (5 - 3);
                            return 0;
                        }

                        function membershipSangatBanyak2(x) {
                            if (x <= 3) return 0;
                            if (x <= 5) return (x - 3) / (5 - 3);
                            return 1;
                        }

                        // Data untuk Chart.js
                        const xValues2 = [];
                        const sangatSedikitValues2 = [];
                        const sedikitValues2 = [];
                        const banyakValues2 = [];
                        const sangatBanyakValues2 = [];

                        for (let x = 0; x <= 7; x += 0.1) {
                            xValues2.push(x.toFixed(1));
                            sangatSedikitValues2.push(membershipSangatSedikit2(x).toFixed(2));
                            sedikitValues2.push(membershipSedikit2(x).toFixed(2));
                            banyakValues2.push(membershipBanyak2(x).toFixed(2));
                            sangatBanyakValues2.push(membershipSangatBanyak2(x).toFixed(2));
                        }

                        // Data untuk Chart.js
                        const data2 = {
                            labels: xValues2,
                            datasets: [{
                                    label: 'Very Low',
                                    borderColor: 'red',
                                    fill: false,
                                    data: sangatSedikitValues2,
                                    pointRadius: 0,
                                },
                                {
                                    label: 'Low',
                                    borderColor: 'orange',
                                    fill: false,
                                    data: sedikitValues2,
                                    pointRadius: 0,
                                },
                                {
                                    label: 'High',
                                    borderColor: 'green',
                                    fill: false,
                                    data: banyakValues2,
                                    pointRadius: 0,
                                },
                                {
                                    label: 'Very High',
                                    borderColor: 'blue',
                                    fill: false,
                                    data: sangatBanyakValues2,
                                    pointRadius: 0,
                                }
                            ]
                        };

                        const config2 = {
                            type: 'line',
                            data: data2,
                            options: {
                                responsive: true,
                                scales: {
                                    x: {
                                        type: 'linear',
                                        position: 'bottom',
                                        min: 0,
                                        max: 7,
                                        title: {
                                            display: true,
                                            text: 'X Axis'
                                        }
                                    },
                                    y: {
                                        min: 0,
                                        max: 1,
                                        title: {
                                            display: true,
                                            text: 'Y Axis'
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top',
                                    },
                                },
                            }
                        };

                        const ctx2 = document.getElementById('chart2').getContext('2d');
                        new Chart(ctx2, config2);
                    });
                </script>
            @endpush
        @endsection
