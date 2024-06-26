@extends('layouts.app')

@section('title', 'Edit Vehicle')

@push('page-css')
    <style>
        #vehicle_model_list {
            position: absolute;
            z-index: 1000;
            width: 100%;
            background-color: white;
            border: 1px solid #ddd;
            max-height: 150px;
            overflow-y: auto;
        }

        #vehicle_model_list li {
            padding: 10px;
            cursor: pointer;
        }

        #vehicle_model_list li:hover {
            background-color: #f0f0f0;
        }
    </style>
@endpush

@section('content')
    <div class="col-sm-12 mb-8">
        <h3 class="page-title text-gray-100">Edit Vehicle</h3>
        <ul class="breadcrumb text-gray-100">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-blue-400">Dashboard</a></li>
            <li class="breadcrumb-item active text-gray-400">Edit Vehicle</li>
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

        <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="model_id" id="model_id" value="{{ $vehicle->model_id }}">
            <div class="mb-4">
                <label for="model_name" class="block text-gray-400">Vehicle Model</label>
                <input type="text" name="model_name" id="model_name" value="{{ $vehicle->model->name }}" class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-300" autocomplete="off" required>
                <ul id="vehicle_model_list" class="hidden"></ul>
            </div>
            <div class="mb-4">
                <label for="plate" class="block text-gray-400">Plate</label>
                <input type="text" name="plate" id="plate" value="{{ $vehicle->plate }}" class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-300" required>
            </div>
            <div class="mb-4">
                <label for="mechanical_state_id" class="block text-gray-400">Mechanical State</label>
                <select name="mechanical_state_id" id="mechanical_state_id" class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-300">
                    @foreach ($mechanicalStates as $state)
                        <option value="{{ $state->id }}" @if($vehicle->mechanical_state_id == $state->id) selected @endif>{{ $state->last_oil_change }} - {{ $state->mileage }} km</option>
                    @endforeach
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

@push('page-js')
<script>
    $(document).ready(function () {
        const modelInput = $('#model_name');
        const modelList = $('#vehicle_model_list');

        modelInput.on('input', function () {
            const query = modelInput.val();
            if (query.length > 0) {
                $.ajax({
                    url: `/vehicle-models/search`,
                    method: 'GET',
                    data: { query: query },
                    success: function (models) {
                        modelList.empty();
                        models.forEach(model => {
                            modelList.append(`<li data-model-id="${model.id}">${model.name} - ${model.constructor}</li>`);
                        });
                        modelList.removeClass('hidden');
                    }
                });
            } else {
                modelList.addClass('hidden');
            }
        });

        modelList.on('click', 'li', function () {
            modelInput.val($(this).text());
            $('#model_id').val($(this).data('model-id'));
            modelList.addClass('hidden');
        });

        $(document).on('click', function (e) {
            if (!modelList.is(e.target) && modelList.has(e.target).length === 0 && !modelInput.is(e.target)) {
                modelList.addClass('hidden');
            }
        });
    });
</script>
@endpush
