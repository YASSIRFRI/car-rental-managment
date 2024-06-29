@extends('layouts.app')

@section('title', 'Dashboard')

@push('page-css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="flex min-h-screen bg-gray-100">
        <div class="flex flex-col flex-1">

            <!-- Main content -->
            <div class="flex-1 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="card bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="card-body p-4 text-center">
                            <i class="fas fa-car fa-3x text-palette-5 mb-4"></i>
                            <h3 class="text-4xl font-bold text-black">{{ $vehicles->count() }}</h3>
                            <h6 class="text-lg text-gray-600">Vehicles</h6>
                        </div>
                    </div>
                    <div class="card bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="card-body p-4 text-center">
                            <i class="fas fa-receipt fa-3x text-green-700 mb-4"></i>
                            <h3 class="text-4xl font-bold text-black">{{ $rentals->count() }}</h3>
                            <h6 class="text-lg text-gray-600">Rentals</h6>
                        </div>
                    </div>
                    <div class="card bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="card-body p-4 text-center">
                            <i class="fas fa-euro-sign fa-3x text-purple-700 mb-4"></i>
                            <h3 class="text-4xl font-bold text-black">0</h3>
                            <h6 class="text-lg text-gray-600">Today's Reservations</h6>
                        </div>
                    </div>
                    <div class="card bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="card-body p-4 text-center">
                            <i class="fas fa-calendar-check fa-3x text-indigo-700 mb-4"></i>
                            <h3 class="text-4xl font-bold text-black">0 €</h3>
                            <h6 class="text-lg text-gray-600">Confirmed Rentals</h6>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <div class="card bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="card-header bg-red-100 p-4">
                            <h4 class="card-title text-red-700 text-2xl"><i class="fas fa-tools mr-2"></i>Cars with Mechanical Issues</h4>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table id="cars-with-issues-table" class="table table-striped table-center w-full">
                                    <thead>
                                        <tr class="text-black">
                                            <th class="text-left">Vehicle</th>
                                            <th class="text-left">Model</th>
                                            <th class="text-left">Issue</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-black">
                                        @foreach ($carsWithIssues as $vehicle)
                                            <tr>
                                                <td class="text-left">{{ $vehicle->plate }}</td>
                                                <td class="text-left">{{ $vehicle->model->name }}</td>
                                                <td class="text-left">
                                                    @if($vehicle->mechanicalState->mileage > 100000)
                                                        High mileage
                                                    @endif
                                                    @if($vehicle->mechanicalState->last_oil_change < Carbon\Carbon::now()->subMonths(6))
                                                        , Oil change needed
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="card bg-white shadow-md rounded-lg overflow-hidden p-4">
                        <h4 class="text-2xl font-bold mb-4"><i class="fas fa-chart-line mr-2"></i>Transactions Volume by Month</h4>
                        <canvas id="transactionsChart"></canvas>
                    </div>
                    <div class="card bg-white shadow-md rounded-lg overflow-hidden p-4">
                        <h4 class="text-2xl font-bold mb-4"><i class="fas fa-sync-alt mr-2"></i>Fleet Rotation Rate</h4>
                        <canvas id="rotationRateChart"></canvas>
                    </div>
                </div>

                <div class="mt-8">
                    <div class="card bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="card-header bg-blue-100 p-4">
                            <h4 class="card-title text-blue-700 text-2xl"><i class="fas fa-car-side mr-2"></i>Cars Available Today</h4>
                        </div>
                        <div class="card-body p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($availableVehicles as $vehicle)
                                <div class="card bg-gray-100 shadow-md rounded-lg overflow-hidden p-4">
                                    <img src="{{ asset('images/' . $vehicle->model->image) }}" alt="{{ $vehicle->model->name }}" class="h-32 w-full object-cover mb-4">
                                    <h4 class="text-xl font-bold">{{ $vehicle->model->name }}</h4>
                                    <p class="text-gray-700">Plate: {{ $vehicle->plate }}</p>
                                    <p class="text-gray-700">Mechanical Status: 
                                        @if($vehicle->mechanicalState->mileage > 100000)
                                            <span class="text-red-500">High mileage</span>
                                        @else
                                            <span class="text-green-500">Good</span>
                                        @endif
                                    </p>
                                    <a href="{{ route('rentals.create', ['vehicle_id' =>$vehicle->id]) }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded">Rent Now</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('page-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script>
    $(document).ready(function() {
    var availableVehiclesCount = {{ $availableVehicles->count() }};
    var rentedVehiclesCount = {{ $rentedVehicles->count() }};
    var unavailableVehiclesCount ={{ $unavailableVehicles}};
    
    var transactionsCtx = document.getElementById('transactionsChart').getContext('2d');
    var transactionsChart = new Chart(transactionsCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Income by Month',
                data: @json(array_values($payments->toArray())), // Add your data here
                backgroundColor: 'rgba(75, 192, 192, 1)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: false 
                    }
                },
                x: {
                    grid: {
                        display: false 
                    }
                }
            }
        }
    });

    var rotationRateCtx = document.getElementById('rotationRateChart').getContext('2d');
    var rotationRateChart = new Chart(rotationRateCtx, {
        type: 'doughnut',
        data: {
            labels: ['Available', 'In Rental', 'Unavailable'],
            datasets: [{
                label: 'Rotation Rate',
                data: [availableVehiclesCount, rentedVehiclesCount, unavailableVehiclesCount],
                backgroundColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)' 
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: false // Remove grid lines
                    }
                },
                x: {
                    grid: {
                        display: false // Remove grid lines
                    }
                }
            }
        }
    });
});

</script>
@endpush
