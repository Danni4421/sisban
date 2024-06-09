<div>
    <canvas id="{{ $id }}" class="w-100"></canvas>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>;
            new Chart(document.getElementById('{{$id}}'), {
                type: 'line',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: {!! json_encode($datasets) !!}, 
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                                display: false,
                                position: 'bottom',
                                labels: {
                                    fontSize: 16,
                                },
                        },
                        title: {
                            display: false,
                            text: "{{ $title }}"
                        },
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            grid: {
                                display: false
                            },
                            min: 0,
                            max:100,
                        },
                    }
                }
            });
        </script>
    @endpush
</div>
