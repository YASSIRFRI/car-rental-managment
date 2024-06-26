<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Client;
use App\Models\Rental;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use App\Rules\AvailableVehicle;
use Carbon\Carbon;

class RentalsController extends Controller
{
    public function index()
    {
        $agencyId = Auth::user()->id;
        $rentals = Rental::whereHas('vehicle', function ($query) use ($agencyId) {
            $query->where('agency_id', $agencyId);
        })->with('client', 'vehicle','payment')->get();
        
        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        $agencyId = Auth::user()->id;
        $vehicles = Vehicle::where('agency_id', $agencyId)->where('availability', true)->get();
        
        return view('rentals.create', compact('vehicles'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'vehicle_id' => ['required', 'exists:vehicles,id', new AvailableVehicle],
        'client_name' => 'required|string|max:255',
        'start_date' => 'required|date|before:end_date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'amount' => 'nullable|numeric',
        'payment_date' => 'nullable|date',
        'payment_method' => 'nullable|string|max:255',
    ]);

    $client = Client::where('name', $validated['client_name'])
                    ->where('agency_id', Auth::id())
                    ->first();

    if (!$client) {
        return redirect()->route('clients.create')
                         ->with('error', 'Client does not exist. Please create a new client.')
                         ->withInput();
    }

    $validated['client_id'] = $client->id;
    unset($validated['client_name']);

    $payment = null;
    if (!empty($validated['amount']) || !empty($validated['payment_date']) || !empty($validated['payment_method'])) {
        $payment = Payment::create([
            'amount' => $validated['amount'],
            'date' => $validated['payment_date'],
            'method' => $validated['payment_method'],
            'date_of_payment' => $validated['payment_date']
        ]);
    }

    $rental = new Rental($validated);
    if ($payment) {
        $rental->payment_id = $payment->id;
    }
    $rental->save();

    if (Carbon::parse($validated['end_date'])->isFuture()) {
        Vehicle::where('id', $validated['vehicle_id'])->update(['availability' => false]);
    }

    return redirect()->route('rentals.index')->with('success', 'Rental created successfully.');
}

    

    public function edit(Rental $rental)
    {
        $agencyId = Auth::user()->id;
        $vehicles = Vehicle::where('agency_id', $agencyId)->where('availability', true)->get();
        $clients = Client::where('agency_id', $agencyId)->get();
        
        return view('rentals.edit', compact('rental', 'vehicles', 'clients'));
    }

    public function update(Request $request, Rental $rental)
    {
        $validated = $request->validate([
            'vehicle_id' => ['required', 'exists:vehicles,id', new AvailableVehicle],
            'client_id' => 'required|exists:clients,id',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'amount' => 'required|numeric',
            'date_of_payment' => 'required|date',
            'method' => 'required|string|max:255',
        ]);

        $payment = $rental->payment;
        if ($payment) {
            $payment->update([
                'amount' => $validated['amount'],
                'date_of_payment' => $validated['date_of_payment'],
                'method' => $validated['method'],
            ]);
        } else {
            $payment = Payment::create([
                'amount' => $validated['amount'],
                'date_of_payment' => $validated['date_of_payment'],
                'method' => $validated['method'],
            ]);
            $rental->update(['payment_id' => $payment->id]);
        }

        $rental->update([
            'vehicle_id' => $validated['vehicle_id'],
            'client_id' => $validated['client_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        ]);

        if (Carbon::parse($validated['end_date'])->isFuture()) {
            Vehicle::where('id', $validated['vehicle_id'])->update(['availability' => false]);
        }

        return redirect()->route('rentals.index')->with('success', 'Rental updated successfully.');
    }

    public function destroy(Rental $rental)
    {
        Vehicle::where('id', $rental->vehicle_id)->update(['availability' => true]);
        $rental->delete();
        
        return redirect()->route('rentals.index')->with('success', 'Rental deleted successfully.');
    }
}
