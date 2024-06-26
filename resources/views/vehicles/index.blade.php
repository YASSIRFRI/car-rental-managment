@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex justify-end mb-4">
            <a href="{{ route('vehicles.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded flex items-center">
                <i class="fas fa-plus mr-2"></i> Create New Vehicle
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($vehicles as $vehicle)
                <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                    <div class="w-full h-48 overflow-hidden">
                        <img src="{{ asset('images/' . $vehicle->model->image) }}" alt="{{ $vehicle->model->name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-xl font-bold">{{ $vehicle->model->name }} - {{ $vehicle->model->constructor }}</h3>
                        <p class="text-gray-700">Plate: {{ $vehicle->plate }}</p>
                        <p class="text-gray-700">Seats: {{ $vehicle->model->number_of_seats }} | HP: {{ $vehicle->model->horsepower }}</p>
                        <div class="mt-2 flex items-center">
                            <span class="text-gray-700 mr-2">Availability:</span>
                            @if($vehicle->availability)
                                <i class="fas fa-check-circle text-green-500"></i>
                            @else
                                <i class="fas fa-times-circle text-red-500"></i>
                            @endif
                        </div>
                        <div class="mt-2 flex items-center">
                            <span class="text-gray-700 mr-2">Mechanical State:</span>
                            @if($vehicle->mechanicalState)
                                <i class="fas fa-wrench text-yellow-500"></i>
                            @else
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                            @endif
                        </div>
                        <div class="mt-4 flex justify-between">
                            <a href="{{ route('vehicles.edit', $vehicle) }}" class="bg-yellow-500 text-white py-1 px-4 rounded">Edit</a>
                            <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white py-1 px-4 rounded">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
