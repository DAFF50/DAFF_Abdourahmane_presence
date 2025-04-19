@php $rap = true @endphp
@extends('template.template')

@section('content')
    <div class="container">
        <h2>Évolution des Présences</h2>

        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="">
                    <div class="row">
                        <div class="col-md-4">
                            <select name="periode" class="form-select" onchange="this.form.submit()">
                                <option value="jour" {{ $periode == 'jour' ? 'selected' : '' }}>Par jour</option>
                                <option value="semaine" {{ $periode == 'semaine' ? 'selected' : '' }}>Par semaine
                                </option>
                                <option value="mois" {{ $periode == 'mois' ? 'selected' : '' }}>Par mois</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="chart-container" style="position: relative; height: 400px;">
                    <canvas id="evolutionChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('evolutionChart').getContext('2d');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Nombre de présences',
                        data: @json($values),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return `${context.dataset.label}: ${context.raw}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
