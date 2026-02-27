@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <h1 class="mb-5 mt-5 text-center bg-light text-dark p-3 rounded shadow-lg">Admin Dashboard</h1>

    <!-- Charts Container -->
    <div class="container d-flex border shadow-lg mb-5 align-items-center justify-content-center p-5">

        <!-- Bar Chart -->
        <div id="users-barGraph" style="width: 100%; max-width: 650px; height:400px; margin-bottom: 50px;"></div>

        <!-- Pie Chart -->
        <div id="users-pieChart" style="width: 100%; max-width: 650px; height:400px; margin-bottom: 50px;"></div>

        <!-- Area / Line Chart -->
        <div id="users-areaChart" style="width: 100%; max-width: 650px; height:400px; margin-bottom: 50px;"></div>

        <div id="users-lineChart" style="width: 100%; max-width: 650px; height:400px; margin-bottom: 50px;"></div>


    </div>

    <!-- User Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center shadow-sm p-3 shadow-lg">
                <h5>Total Users</h5>
                <p class="display-6">{{ $totalUsers }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm p-3 shadow-lg">
                <h5>Active Users</h5>
                <p class="display-6 text-success">{{ $activeUsers }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm p-3 shadow-lg">
                <h5>Inactive Users</h5>
                <p class="display-6 text-warning">{{ $inactiveUsers }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm p-3 shadow-lg">
                <h5>Suspended Users</h5>
                <p class="display-6 text-danger">{{ $suspendedUsers }}</p>
            </div>
        </div>
    </div>

    <!-- Recent Users Table -->
    <h4>Recent Users</h4>
    <table class="table custom-danger-striped shadow-lg mb-5">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentUsers as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ strtoupper($user->role) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- ApexCharts Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ---- Bar Chart ----
    var barOptions = {
        chart: { type: 'bar', height: 400 },
        plotOptions: { bar: { distributed: true } },
        series: [{
            name: 'Users',
            data: [{{ $activeUsers ?? 0 }}, {{ $inactiveUsers ?? 0 }}, {{ $suspendedUsers ?? 0 }}]
        }],
        colors: ['#28a745', '#ffc107', '#dc3545'],
        xaxis: { categories: ['Active', 'Inactive', 'Suspended'] },
        dataLabels: { enabled: true }
    };
    var barChart = new ApexCharts(document.querySelector("#users-barGraph"), barOptions);
    barChart.render();

    // ---- Pie / Donut Chart ----
    var pieOptions = {
        chart: { type: 'donut', height: 400 },
        series: [{{ $activeUsers ?? 0 }}, {{ $inactiveUsers ?? 0 }}, {{ $suspendedUsers ?? 0 }}],
        labels: ['Active', 'Inactive', 'Suspended'],
        colors: ['#28a745', '#ffc107', '#dc3545'],
        legend: { position: 'bottom' }
    };
    var pieChart = new ApexCharts(document.querySelector("#users-pieChart"), pieOptions);
    pieChart.render();

    // ---- Area Chart ----
    var areaOptions = {
        chart: { type: 'area', height: 400 },
        series: [{
            name: 'Users',
            data: [{{ $activeUsers ?? 0 }}, {{ $inactiveUsers ?? 0 }}, {{ $suspendedUsers ?? 0 }}]
        }],
        xaxis: { categories: ['Active', 'Inactive', 'Suspended'] },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth' },
        colors: ['#28a745', '#ffc107', '#dc3545'],
        tooltip: { shared: true }
    };
    var areaChart = new ApexCharts(document.querySelector("#users-areaChart"), areaOptions);
    areaChart.render();

    // ---- Line Chart ----
    var lineOptions = {
        chart: { type: 'line', height: 400 },
        series: [{
            name: 'Users',
            data: [{{ $activeUsers ?? 0 }}, {{ $inactiveUsers ?? 0 }}, {{ $suspendedUsers ?? 0 }}]
        }],
        xaxis: { categories: ['Active', 'Inactive', 'Suspended'] },
        stroke: { curve: 'smooth' },
        colors: ['#28a745', '#ffc107', '#dc3545'],
        markers: { size: 5 },
        tooltip: { shared: true }
    };
    var lineChart = new ApexCharts(document.querySelector("#users-lineChart"), lineOptions);
    lineChart.render();

});
</script>
@endsection