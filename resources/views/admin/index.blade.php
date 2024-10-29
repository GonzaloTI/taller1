@extends('layouts.app')
@section('title', 'Index Admin')
@section('content')

<!-- Gráficos y reportes -->
<div class="row">
    <!-- Gráfico de visitantes por semana (más grande) -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Visitantes por Semana</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="visitantesChart" style="height: 400px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Gráfico de visitas por dispositivo (nuevo gráfico) -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Visitas por Dispositivo</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="dispositivosChart" style="height: 400px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Gráfico de ingresos mensuales (más grande) -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Ingresos Mensuales</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="ingresosChart" style="height: 400px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<!-- Include Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar el gráfico de visitantes
        var visitantesCtx = document.getElementById('visitantesChart').getContext('2d');
        var visitantesChart = new Chart(visitantesCtx, {
            type: 'bar',
            data: {
                labels: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'],
                datasets: [{
                    label: 'Visitantes',
                    data: [12, 19, 3, 5, 2],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Inicializar el gráfico de dispositivos
        var dispositivosCtx = document.getElementById('dispositivosChart').getContext('2d');
        var dispositivosChart = new Chart(dispositivosCtx, {
            type: 'pie',
            data: {
                labels: ['Móvil', 'Escritorio', 'Tablet'],
                datasets: [{
                    label: 'Visitas por Dispositivo',
                    data: [15, 30, 5],
                    backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });

        // Inicializar el gráfico de ingresos
        var ingresosCtx = document.getElementById('ingresosChart').getContext('2d');
        var ingresosChart = new Chart(ingresosCtx, {
            type: 'line',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
                datasets: [{
                    label: 'Ingresos Mensuales',
                    data: [3000, 4000, 2000, 5000, 7000, 6000],
                    fill: false,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
