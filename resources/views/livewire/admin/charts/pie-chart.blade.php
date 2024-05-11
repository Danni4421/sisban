<div>
    <canvas id="{{ $id }}"></canvas>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>;
            new Chart(document.getElementById('{{$id}}'), {
                type: 'pie',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: {!! json_encode($datasets) !!}, 
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            usePointStyle: true,
                            callbacks: {
                                label: function (context) {
                                    const length = context.dataset.data.reduce((acc, current) => acc + current, 0);
                                    const percentile = (context.raw / length) * 100;

                                    return `${percentile.toFixed(1)}%, Total: ${context.raw}`;
                                }
                            }
                        },
                        legend: {
                                display: true,
                                position: 'bottom',
                                labels: {
                                fontSize: 16,
                            },
                        },
                        title: {
                            display: true,
                            text: "{{ $title }}"
                        },
                    },
                    dataLabels: {
                        display: true,
                        formatter: (value, context) => `${value}%`,
                        color: 'white',
                    },
                }
            });
        </script>
    @endpush
</div>
