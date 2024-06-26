@extends('layouts.app')

@section('title', 'Client Details')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
    <h2 class="text-2xl font-bold mb-4">{{ $client->name }}</h2>
    <p><strong>Phone:</strong> {{ $client->phone }}</p>
    <p><strong>Email:</strong> {{ $client->email }}</p>

    <h3 class="text-xl font-bold mt-6 mb-4">Rental History</h3>
    <form id="invoiceForm" action="{{ route('invoices.generate') }}" method="POST">
        @csrf
        <table class="min-w-full bg-white">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="text-center">Vehicle</th>
                    <th class="text-center">Start Date</th>
                    <th class="text-center">End Date</th>
                    <th class="text-center">Select for Invoice</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($rentals as $rental)
                    <tr>
                        <td class="text-center">{{ $rental->vehicle->model->name }}</td>
                        <td class="text-center">{{ $rental->start_date }}</td>
                        <td class="text-center">{{ $rental->end_date }}</td>
                        <td class="text-center">
                            <input type="checkbox" name="rental_ids[]" value="{{ $rental->id }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Generate Invoice</button>
        </div>
    </form>
</div>
@endsection
