@extends('layouts.app')

@section('title', 'Add Client')

@push('page-css')
    <!-- Add any additional CSS needed for this page here -->
@endpush

@section('content')


<div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
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

    <form action="{{ route('clients.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        <div class="mb-4">
            <label for="phone" class="block text-gray-700">Phone</label>
            <input type="text" name="phone" id="phone" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        <div class="mb-4">
            <label for="type" class="block text-gray-700">Type</label>
            <select name="type" id="type" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                <option value="personne physique">Personne Physique</option>
                <option value="personne morale">Personne Morale</option>
            </select>
        </div>
        <div class="mb-4" id="cin-field" style="display: none;">
            <label for="cin" class="block text-gray-700">CIN</label>
            <input type="text" name="cin" id="cin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4" id="ice-field" style="display: none;">
            <label for="ice" class="block text-gray-700">ICE</label>
            <input type="text" name="ice" id="ice" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4" id="address-field" style="display: none;">
            <label for="address" class="block text-gray-700">Address</label>
            <input type="text" name="address" id="address" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4" id="city-field" style="display: none;">
            <label for="city" class="block text-gray-700">City</label>
            <input type="text" name="city" id="city" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-palette-5 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Add Client
            </button>
        </div>
    </form>
</div>
@endsection

@push('page-js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typeSelect = document.getElementById('type');
        const cinField = document.getElementById('cin-field');
        const iceField = document.getElementById('ice-field');
        const addressField = document.getElementById('address-field');
        const cityField = document.getElementById('city-field');

        typeSelect.addEventListener('change', function () {
            if (typeSelect.value === 'personne physique') {
                cinField.style.display = 'block';
                iceField.style.display = 'none';
                addressField.style.display = 'block';
                cityField.style.display = 'block';
            } else {
                cinField.style.display = 'none';
                iceField.style.display = 'block';
                addressField.style.display = 'block';
                cityField.style.display = 'block';
            }
        });

        typeSelect.dispatchEvent(new Event('change'));
    });
</script>
@endpush
