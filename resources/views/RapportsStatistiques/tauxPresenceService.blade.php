@extends('template')

@section('content')
    <div class="container">
        <h2>Taux de présence par service</h2>

        <div class="row">
            <div class="col-md-6">
                <div class="chart-container" style="position: relative; height:400px; width:400px">
                    <canvas id="doughnutChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Service</th>
                        <th>Taux de présence</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(array_combine($services, $tauxPresence) as $service => $taux)
                        <tr>
                            <td>{{ $service }}</td>
                            <td>{{ $taux }}%</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('doughnutChart').getContext('2d');

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: @json($services),
                    datasets: [{
                        data: @json($tauxPresence),
                        backgroundColor: @json($couleurs),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.raw}%`;
                                }
                            }
                        }
                    },
                    cutout: '70%' // Pour un effet "doughnut" (anneau)
                }
            });
        });
    </script>
@endsection
