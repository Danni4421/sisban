<div>
    <canvas id="barchart"></canvas>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>;
            new Chart(document.getElementById('barchart'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: {!! json_encode($datasets) !!},
                },
                options: {
                    responsive: true,
                    scale: {
                        min: 0,
                        max: 60
                    }
                }
            });
        </script>
    @endpush
</div>
