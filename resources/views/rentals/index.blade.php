@extends("layouts.app")

@section('content')
    <div class="mb-6">
        <a href="{{ route('rentals.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Create New Rental</a>
    </div>
    <table class="min-w-full bg-white">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="w-1/4 py-2">Vehicle</th>
                <th class="w-1/4 py-2">Client</th>
                <th class="w-1/4 py-2">Start Date</th>
                <th class="w-1/4 py-2">End Date</th>
                <th class="py-2">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @foreach($rentals as $rental)
                <tr>
                    <td class="w-1/4 py-2">{{ $rental->vehicle->name }}</td>
                    <td class="w-1/4 py-2">{{ $rental->client->name }}</td>
                    <td class="w-1/4 py-2">{{ $rental->start_date }}</td>
                    <td class="w-1/4 py-2">{{ $rental->end_date }}</td>
                    <td class="py-2">
                        <form action="{{ route('rentals.destroy', $rental) }}" method="POST" class="inline">
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
