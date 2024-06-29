@extends('layouts.app')

@section('title', 'Ajouter une Location')

@push('page-css')
    <style>
        #client_list, #vehicle_list {
            position: absolute;
            z-index: 1000;
            width: 100%;
            background-color: white;
            border: 1px solid #ddd;
            max-height: 150px;
            overflow-y: auto;
        }

        #client_list li, #vehicle_list li {
            padding: 10px;
            cursor: pointer;
        }

        #client_list li:hover, #vehicle_list li:hover {
            background-color: #f0f0f0;
        }

        .vehicle-item {
            display: flex;
            align-items: center;
        }

        .vehicle-item img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            margin-right: 10px;
        }

        .form-input {
            background-color: #f9fafb;
            border-radius: 0.375rem;
            border:1px;
            transition: border-color 0.3s;
        }

        .form-input:focus {
            border-color: #7e3af2;
            background-color: #ffffff;
        }
        
        .hidden {
            display: none;
        }
    </style>
@endpush

@section('content')
<div class="col-sm-12 mb-8">
    <h3 class="page-title">Ajouter une Nouvelle Location</h3>
</div>

<div class="bg-gray-200 shadow-md w-2/3 mx-auto overflow-hidden rounded-lg p-6">
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Whoops!</strong> Il y a eu des problèmes avec votre saisie.<br><br>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rentals.store') }}" method="POST">
        @csrf
        <div class="mb-4 relative">
            <label for="vehicle_name" class="block text-gray-800">Véhicule</label>
            <input type="text" name="vehicle_name" id="vehicle_name" class="form-input mt-1 block w-full px-3 py-2 border bg-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-800" autocomplete="off" required>
            <input type="hidden" name="vehicle_id" id="vehicle_id">
            <ul id="vehicle_list" class="hidden"></ul>
        </div>
        <div class="mb-4 relative flex align-center justify-between w-full">
            <div >
                <label for="client_name" class="block text-gray-800">Nom du Client</label>
                <input type="text" name="client_name" id="client_name" class="form-input mt-1 block w-full px-3 py-2 border bg-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-800" autocomplete="off" required>
                <ul id="client_list" class="hidden"></ul>
            </div>
            <button type="button" id="new-client-button" class="mt-2 mb-2 bg-gray-800 text-white px-3 rounded"><i class="fas fa-plus mr-2"></i>
            <i class="fas fa-user"></i></button>
        </div>
        <div id="new-client-form" class="hidden">
            <div class="mb-4">
                <label for="client_type" class="block text-gray-800">Type de Client</label>
                <select name="client_type" id="client_type" class="form-input mt-1 block w-full px-3 py-2 border bg-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-800">
                    <option value="personne_physique">Personne Physique</option>
                    <option value="personne_morale">Personne Morale</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="client_cin" class="block text-gray-800">CIN</label>
                <input type="text" name="client_cin" id="client_cin" class="form-input mt-1 block w-full px-3 py-2 border bg-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-800">
            </div>
            <div class="mb-4">
                <label for="client_ice" class="block text-gray-800">ICE</label>
                <input type="text" name="client_ice" id="client_ice" class="form-input mt-1 block w-full px-3 py-2 border bg-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-800">
            </div>
            <div class="mb-4">
                <label for="client_address" class="block text-gray-800">Adresse</label>
                <input type="text" name="client_address" id="client_address" class="form-input mt-1 block w-full px-3 py-2 border bg-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-800">
            </div>
            <div class="mb-4">
                <label for="client_city" class="block text-gray-800">Ville</label>
                <input type="text" name="client_city" id="client_city" class="form-input mt-1 block w-full px-3 py-2 border bg-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-800">
            </div>
        </div>
        <div class="mb-4">
            <label for="start_date" class="block text-gray-800">Date de Début</label>
            <input type="date" name="start_date" id="start_date" class="form-input mt-1 block w-full px-3 py-2 border bg-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-800" required>
        </div>
        <div class="mb-4">
            <label for="end_date" class="block text-gray-800">Date de Fin</label>
            <input type="date" name="end_date" id="end_date" class="form-input mt-1 block w-full px-3 py-2 border bg-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-800" required>
        </div>
        <div class="mb-4">
            <label for="nombre_jour" class="block text-gray-800">Nombre de Jours</label>
            <input type="number" name="nombre_jour" id="nombre_jour" class="form-input mt-1 block w-full px-3 py-2 border bg-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-800">
        </div>
        <div class="mb-4">
            <label for="prix_par_jour" class="block text-gray-800">Prix par Jour</label>
            <input type="text" name="prix_par_jour" id="prix_par_jour" class="form-input mt-1 block w-full px-3 py-2 border bg-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-800">
        </div>
        <div class="mb-4">
            <label for="total" class="block text-gray-800">Total</label>
            <input type="text" name="amount" id="total" class="form-input mt-1 block w-full px-3 py-2 border bg-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-800" readonly>
        </div>
        <div class="mb-4">
            <label for="payment_date" class="block text-gray-800">Date de payment</label>
            <input type="date" name="payment_date" id="payment_date" class="form-input mt-1 block w-full px-3 py-2 border bg-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-800">
        </div>
        <div class="mb-4">
            <label for="payment_method" class="block text-gray-800">Methode de payment</label>
            <input type="text" name="payment_method" id="payment_method" class="form-input mt-1 block w-full px-3 py-2 border bg-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-800">
        </div>
        <div class="flex flex-col items-center">
            <button type="submit" class="w-1/2 py-2 px-4 border rounded-lg border-transparent shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Ajouter la Location
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
        const vehicleInput = $('#vehicle_name');
        const vehicleList = $('#vehicle_list');
        const vehicleIdInput = $('#vehicle_id');
        const startDateInput = $('#start_date');
        const endDateInput = $('#end_date');
        const nombreDeJourInput = $('#nombre_jour');
        const prixParJourInput = $('#prix_par_jour');
        const totalInput = $('#total');
        const newClientButton = $('#new-client-button');
        const newClientForm = $('#new-client-form');

        newClientButton.on('click', function() {
            newClientForm.toggleClass('hidden');
        });

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

        vehicleInput.on('input', function () {
            const query = vehicleInput.val();
            if (query.length > 0) {
                $.ajax({
                    url: `/vehicles/search`,
                    method: 'GET',
                    data: { query: query },
                    success: function (vehicles) {
                        console.log(vehicles);
                        vehicleList.empty();
                        vehicles.forEach(vehicle => {
                            vehicleList.append(`<li class="vehicle-item" data-vehicle-id="${vehicle.id}"><img src="{{ asset('images/') }}/${vehicle.model.image}" alt="${vehicle.model.name}">${vehicle.model.name} - ${vehicle.model.constructor}</li>`);
                        });
                        vehicleList.removeClass('hidden');
                    }
                });
            } else {
                vehicleList.addClass('hidden');
            }
        });

        vehicleList.on('click', 'li', function () {
            vehicleInput.val($(this).text());
            vehicleIdInput.val($(this).data('vehicle-id'));
            vehicleList.addClass('hidden');
        });

        $(document).on('click', function (e) {
            if (!vehicleList.is(e.target) && vehicleList.has(e.target).length === 0 && !vehicleInput.is(e.target)) {
                vehicleList.addClass('hidden');
            }
        });

        startDateInput.on('change', calculateDays);
        endDateInput.on('change', calculateDays);
        nombreDeJourInput.on('input', calculateEndDate);
        prixParJourInput.on('input', calculateTotal);

        function calculateDays() {
            const startDate = new Date(startDateInput.val());
            const endDate = new Date(endDateInput.val());
            if (!isNaN(startDate) && !isNaN(endDate) && startDate <= endDate) {
                const diffTime = Math.abs(endDate - startDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                nombreDeJourInput.val(diffDays);
                calculateTotal();
            }
        }

        function calculateEndDate() {
            const startDate = new Date(startDateInput.val());
            const days = parseInt(nombreDeJourInput.val(), 10);
            if (!isNaN(startDate) && !isNaN(days)) {
                const endDate = new Date(startDate);
                endDate.setDate(startDate.getDate() + days);
                const formattedEndDate = endDate.toISOString().split('T')[0];
                endDateInput.val(formattedEndDate);
                calculateTotal();
            }
        }

        function calculateTotal() {
            const days = parseInt(nombreDeJourInput.val(), 10);
            const pricePerDay = parseFloat(prixParJourInput.val());
            if (!isNaN(days) && !isNaN(pricePerDay)) {
                const total = days * pricePerDay;
                totalInput.val(total.toFixed(2));
            }
        }
    });
</script>
@endpush
