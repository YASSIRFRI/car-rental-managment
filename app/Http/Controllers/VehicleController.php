<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    public function index()
    {
        $agencyId = Auth::user()->id;
        $vehicles = Vehicle::where('agency_id', $agencyId)->get();
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'availability' => 'required|boolean',
        ]);

        $validated['agency_id'] = Auth::user()->id;

        Vehicle::create($validated);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'availability' => 'required|boolean',
        ]);

        $vehicle->update($validated);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $agencyId = Auth::user()->id;
        $vehicles = Vehicle::where('agency_id', $agencyId)
            ->where('availability', true)
            ->where('name', 'LIKE', "%{$query}%")
            ->get();
        return response()->json($vehicles);
    }
}
