<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use App\Models\MechanicalState;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    public function index()
    {
        $agencyId = Auth::user()->id;
        $vehicles = Vehicle::with(['model', 'mechanicalState'])
            ->where('agency_id', $agencyId)
            ->get();

        return view('vehicles.index', compact('vehicles'));
    }
    public function create()
    {
        $mechanicalStates = MechanicalState::all();
        return view('vehicles.create', compact('mechanicalStates'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'plate' => 'required|string|max:255|unique:vehicles,plate',
            'price' => 'required|numeric',
            'model_id' => 'required|exists:vehicle_models,id',
            'mileage' => 'required|numeric',
            'last_oil_change' => 'required|date',
            'tax_value' => 'required|numeric',
            'last_tax_pay' => 'required|date',
        ]);
    
        $validated['agency_id'] = Auth::user()->id;
    
        $vehicle = Vehicle::create($validated);
    
        // Create the mechanical state and associate it with the vehicle
        $mechanicalState = MechanicalState::create([
            'vehicle_id' => $vehicle->id, // Set the vehicle ID here
            'mileage' => $validated['mileage'],
            'last_oil_change' => $validated['last_oil_change'],
            'last_tax_pay' => $validated['last_tax_pay'],
        ]);
    
        $vehicle->update(['mechanical_state_id' => $mechanicalState->id]);
    
        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
    }
    
    
    


    public function edit(Vehicle $vehicle)
    {
        $mechanicalStates = MechanicalState::all();
        return view('vehicles.edit', compact('vehicle', 'mechanicalStates'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'availability' => 'required|boolean',
            'plate' => 'required|string|max:255|unique:vehicles,plate',
            'model_id' => 'required|exists:vehicle_models,id',
            'mechanical_state_id' => 'nullable|exists:mechanical_states,id'
        ]);

        $vehicle->update($validated);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }

    public function show(Request $request)
    {
        $query = $request->input('query');
        $agencyId = Auth::user()->id;

        $vehicles = Vehicle::where('agency_id', $agencyId)
            ->where('availability', true)
            ->whereHas('model', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->with('model')
            ->get();

        return response()->json($vehicles);
    }
}
