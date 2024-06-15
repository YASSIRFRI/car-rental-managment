@extends('layouts.app')

@section('title', 'Clients')

@push('page-css')
    <!-- Add any additional CSS needed for this page here -->
@endpush

@section('content')
<div class="col-sm-12 mb-4">
    <h3 class="page-title text-black">Clients</h3>
    <ul class="breadcrumb text-black">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Clients</li>
    </ul>
</div>

<div class="flex justify-between mb-4">
    <div>
        <a href="{{ route('clients.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Add Client</a>
    </div>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Success!</strong> {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table id="clients-table" class="table table-striped table-center w-full text-black">
            <thead>
                <tr class="text-black">
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-black">
                @foreach ($clients as $client)
                    <tr>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->email }}</td>
                        <td>
                            <a href="{{ route('clients.edit', $client->id) }}" class="bg-yellow-500 text-white py-1 px-3 rounded">Edit</a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('page-js')
    <script>
        $(document).ready(function() {
            $('#clients-table').DataTable();
        });
    </script>
@endpush
