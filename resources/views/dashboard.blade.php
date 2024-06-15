@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="flex min-h-screen bg-gray-100">
        <div class="flex flex-col flex-1">
            <div class="flex-1 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="card bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="card-body p-4">
                            <div class="dash-widget-header flex items-center">
                                <div class="dash-count text-4xl font-bold text-black">
                                    <h3>{{ $vehicles->count() }}</h3>
                                </div>
                            </div>
                            <div class="dash-widget-info mt-4">
                                <h6 class="text-success text-lg"> Vehicles</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="card-body p-4">
                            <div class="dash-widget-header flex items-center">
                                <div class="dash-count text-4xl font-bold text-black">
                                    <h3>{{ $rentals->count() }}</h3>
                                </div>
                            </div>
                            <div class="dash-widget-info mt-4">
                                <h6 class="text-primary text-lg"> Rentals</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <div class="card bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="card-header bg-green-100 p-4">
                            <h4 class="card-title text-success text-2xl">Recent Rental History</h4>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table id="rentals-table" class="table table-striped table-center w-full">
                                    <thead>
                                        <tr class="text-black">
                                            <th>Vehicle</th>
                                            <th>Renter Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-black">
                                        <!-- Dynamic rows will be loaded here via DataTable -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
<script>
    $(document).ready(function() {
        var table = $('#rentals-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('rentals.index') }}",
            columns: [
                { data: 'vehicle', name: 'vehicle' },
                { data: 'renter_name', name: 'renter_name' },
                { data: 'start_date', name: 'start_date' },
                { data: 'end_date', name: 'end_date' },
            ]
        });
    });
</script>
@endpush
