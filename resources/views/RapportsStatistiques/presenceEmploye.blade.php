@php $rap = true @endphp
@extends('template.template')

@section('content')
    <div class="container">
        <h2>Présences par employé</h2>
        <div class="chart-container" style="position: relative; height:400px; width:800px">
            <canvas id="presenceChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('presenceChart').getContext('2d');

            const presenceChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($employes),
                    datasets: [{
                        label: 'Nombre de présences',
                        data: @json($totaux),
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Nombre de présences'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Employés'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
