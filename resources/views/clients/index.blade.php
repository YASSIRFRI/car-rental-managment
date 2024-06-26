@extends('layouts.app')

@section('content')
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
                    <th class="text-center">Name</th>
                    <th class="text-center">Phone</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-black">
                @foreach ($clients as $client)
                    <tr>
                        <td class="text-center">{{ $client->name }}</td>
                        <td class="text-center">{{ $client->phone }}</td>
                        <td class="text-center">{{ $client->email }}</td>
                        <td class="text-center">
                            <a href="{{ route('clients.show', $client->id) }}" class="bg-blue-500 text-white py-1 px-3 rounded"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('clients.edit', $client->id) }}" class="bg-yellow-500 text-white py-1 px-3 rounded"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
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
