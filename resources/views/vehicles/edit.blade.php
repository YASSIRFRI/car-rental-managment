@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Edit Vehicle</h2>
        <form method="POST" action="{{ route('vehicles.update', $vehicle) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input id="name" name="name" type="text" value="{{ $vehicle->name }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
                <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                <input id="model" name="model" type="text" value="{{ $vehicle->model }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                <input id="type" name="type" type="text" value="{{ $vehicle->type }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <input id="status" name="status" type="text" value="{{ $vehicle->status }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
                <label for="availability" class="block text-sm font-medium text-gray-700">Availability</label>
                <select id="availability" name="availability" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="1" {{ $vehicle->availability ? 'selected' : '' }}>Available</option>
                    <option value="0" {{ !$vehicle->availability ? 'selected' : '' }}>Not Available</option>
                </select>
            </div>
            <div>
                <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Update Vehicle
                </button>
            </div>
        </form>
    </div>
@endsection
