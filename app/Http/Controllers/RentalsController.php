<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Client;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;

class RentalsController extends Controller
{
    public function index()
    {
        $agencyId = Auth::user()->id;
        $rentals = Rental::whereHas('vehicle', function($query) use ($agencyId) {
            $query->where('agency_id', $agencyId);
        })->with('vehicle', 'client')->get();

        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        $vehicles = Vehicle::where('agency_id', Auth::user()->id)->get();
        return view('rentals.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'client_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $client = Client::firstOrCreate(['name' => $validated['client_name']]);

        $validated['client_id'] = $client->id;
        unset($validated['client_name']);

        Rental::create($validated);

        return redirect()->route('rentals.index')->with('success', 'Rental created successfully.');
    }

    public function edit(Rental $rental)
    {
        $vehicles = Vehicle::where('agency_id', Auth::user()->id)->get();
        $clients = Client::all();
        return view('rentals.edit', compact('rental', 'vehicles', 'clients'));
    }

    public function update(Request $request, Rental $rental)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'client_id' => 'required|exists:clients,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $rental->update($validated);

        return redirect()->route('rentals.index')->with('success', 'Rental updated successfully.');
    }

    public function destroy(Rental $rental)
    {
        $rental->delete();

        return redirect()->route('rentals.index')->with('success', 'Rental deleted successfully.');
    }
}
