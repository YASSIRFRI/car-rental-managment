@extends('layouts.app')

@section('title', 'Edit Rental')

@push('page-css')
    <style>
        #client_list {
            position: absolute;
            z-index: 1000;
            width: 100%;
            background-color: white;
            border: 1px solid #ddd;
            max-height: 150px;
            overflow-y: auto;
        }

        #client_list li {
            padding: 10px;
            cursor: pointer;
        }

        #client_list li:hover {
            background-color: #f0f0f0;
        }
    </style>
@endpush

@section('content')
<div class="col-sm-12 mb-8">
    <h3 class="page-title text-gray-100">Edit Rental</h3>
    <ul class="breadcrumb text-gray-100">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-blue-400">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('rentals.index') }}" class="text-blue-400">Rentals</a></li>
        <li class="breadcrumb-item active text-gray-400">Edit Rental</li>
    </ul>
</div>

<div class="bg-gray-800 shadow-md rounded-lg overflow-hidden p-6">
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Whoops!</strong> There were some problems with your input.<br><br>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rentals.update', $rental->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="vehicle_id" class="block text-gray-400">Vehicle</label>
            <select name="vehicle_id" id="vehicle_id" class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-300">
                @foreach ($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" {{ $vehicle->id == $rental->vehicle_id ? 'selected' : '' }}>{{ $vehicle->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="client_name" class="block text-gray-400">Client Name</label>
            <input type="text" name="client_name" id="client_name" value="{{ $rental->client->name }}" class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-300" autocomplete="off" required>
            <ul id="client_list" class="hidden"></ul>
        </div>
        <div class="mb-4">
            <label for="start_date" class="block text-gray-400">Start Date</label>
            <input type="date" name="start_date" id="start_date" value="{{ $rental->start_date }}" class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-300" required>
        </div>
        <div class="mb-4">
            <label for="end_date" class="block text-gray-400">End Date</label>
            <input type="date" name="end_date" id="end_date" value="{{ $rental->end_date }}" class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-300" required>
        </div>
        <div>
            <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Update Rental
            </button>
        </div>
    </form>
</div>
@endsection

@push('page-js')
<script>
    $(document).ready(function () {
        const clientInput = $('#client_name');
        const clientList = $('#client_list');

        clientInput.on('input', function () {
            const query = clientInput.val();
            if (query.length > 0) {
                $.ajax({
                    url: `/clients/search`,
                    method: 'GET',
                    data: { query: query },
                    success: function (clients) {
                        clientList.empty();
                        clients.forEach(client => {
                            clientList.append(`<li data-client-id="${client.id}">${client.name}</li>`);
                        });
                        clientList.removeClass('hidden');
                    }
                });
            } else {
                clientList.addClass('hidden');
            }
        });

        clientList.on('click', 'li', function () {
            clientInput.val($(this).text());
            clientList.addClass('hidden');
        });

        $(document).on('click', function (e) {
            if (!clientList.is(e.target) && clientList.has(e.target).length === 0 && !clientInput.is(e.target)) {
                clientList.addClass('hidden');
            }
        });
    });
</script>
@endpush
