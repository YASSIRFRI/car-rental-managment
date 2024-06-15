@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <a href="{{ route('vehicles.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Add New Vehicle</a>
    </div>
    <table class="min-w-full bg-white">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="w-1/4 py-2">Name</th>
                <th class="w-1/4 py-2">Model</th>
                <th class="w-1/4 py-2">Type</th>
                <th class="w-1/4 py-2">Status</th>
                <th class="w-1/4 py-2">Availability</th>
                <th class="py-2">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @foreach($vehicles as $vehicle)
                <tr>
                    <td class="w-1/4 py-2">{{ $vehicle->name }}</td>
                    <td class="w-1/4 py-2">{{ $vehicle->model }}</td>
                    <td class="w-1/4 py-2">{{ $vehicle->type }}</td>
                    <td class="w-1/4 py-2">{{ $vehicle->status }}</td>
                    <td class="w-1/4 py-2">{{ $vehicle->availability ? 'Available' : 'Not Available' }}</td>
                    <td class="py-2">
                        <a href="{{ route('vehicles.edit', $vehicle) }}" class="bg-yellow-500 text-white py-1 px-2 rounded">Edit</a>
                        <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white py-1 px-2 rounded">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
