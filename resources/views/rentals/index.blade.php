@extends("layouts.app")

@section('content')
    <table class="min-w-full bg-white">
        <thead class="bg-gray-800 text-white">
            <tr class="text-center">
                <th class="w-1/6 py-2">Vehicle</th>
                <th class="w-1/6 py-2">Client</th>
                <th class="w-1/6 py-2">Start Date</th>
                <th class="w-1/6 py-2">End Date</th>
                <th class="w-1/6 py-2">Payment Status</th>
                <th class="w-1/6 py-2">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 text-center">
            @foreach($rentals as $rental)
                <tr>
                    <td class="text-left flex items-center py-2">
                        <img src="{{ asset('images/' . $rental->vehicle->model->image) }}" alt="{{ $rental->vehicle->model->name }}" class="h-8 w-8 mr-2">
                        {{ $rental->vehicle->model->name }}
                    </td>
                    <td class="w-1/6 py-2">{{ $rental->client->name }}</td>
                    <td class="w-1/6 py-2">{{ $rental->start_date }}</td>
                    <td class="w-1/6 py-2">{{ $rental->end_date }}</td>
                    <td class="w-1/6 py-2">
                        @if($rental->payment)
                            <span class="text-green-500">Paid</span>
                        @else
                            <span class="text-red-500">Not Paid</span>
                        @endif
                    </td>
                    <td class="flex px-2 py-2 justify-center">
                        <a href="{{ route('rentals.edit', $rental) }}" class="bg-yellow-700 text-white mx-2 py-1 px-2 rounded"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('rentals.destroy', $rental) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-700 text-white py-1 px-2 rounded"><i class="fas fa-trash"></i></button>
                        </form>
                        <form action="{{ route('contracts.generate') }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="rental_id" value="{{ $rental->id }}">
                            <button type="submit" class="bg-blue-700 text-white py-1 px-2 rounded ml-2"><i class="fa fa-file-word-o" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-6 flex justify-center">
        <a href="{{ route('rentals.create') }}" class="bg-blue-700 text-white py-2 px-4 rounded">Create New Rental</a>
    </div>
@endsection
