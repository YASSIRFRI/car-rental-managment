<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::where('agency_id', Auth::id())->get();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'email' => 'required|string|email|max:255|unique:clients',
                'type' => 'required|string|in:personne physique,personne morale,SARL',
                'ice' => 'nullable|string|max:255',
                'cin' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
            ]);

        $validated['agency_id'] = Auth::id();

        Client::create($validated);

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:clients,email,' . $client->id,
            'type' => 'required|string|in:personne physique,personne morale',
            'ice' => 'nullable|string|max:255',
            'cin' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ]);

        $client->update($validated);

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $clients = Client::where('name', 'LIKE', "%{$query}%")
                          ->where('agency_id', Auth::id())
                          ->get();
        return response()->json($clients);
    }

    public function show(Client $client)
    {
        $agencyId = Auth::user()->id;
        $rentals = Rental::where('client_id', $client->id)
                        ->whereHas('vehicle', function ($query) use ($agencyId) {
                            $query->where('agency_id', $agencyId);
                        })->with('vehicle')
                        ->get();
    
        return view('clients.show', compact('client', 'rentals'));
    }
}
