<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContractService;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller
{
    public function generate(Request $request, ContractService $contractService)
    {
        $request->validate([
            'rental_id' => 'required|exists:rentals,id',
        ]);

        $rental = Rental::with(['client', 'vehicle', 'vehicle.model', 'vehicle.mechanicalState'])->findOrFail($request->rental_id);
        $client = $rental->client;
        $vehicle = $rental->vehicle;
        $agency = Auth::user();

        $contract = $contractService->generate($client, $vehicle, $agency);

        return response()->download($contract->getPath(), $contract->getFilename())->with('success', 'Contract generated successfully.');
    }
}
