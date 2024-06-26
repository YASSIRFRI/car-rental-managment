<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InvoiceService;
use App\Models\Rental;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function generate(Request $request, InvoiceService $invoiceService)
    {
        $request->validate([
            'rental_ids' => 'required|array',
            'rental_ids.*' => 'exists:rentals,id',
        ]);

        $rentals = Rental::whereIn('id', $request->rental_ids)->get();
        $client = Client::findOrFail($rentals->first()->client_id);
        $agency = Auth::user(); // Assuming the authenticated user is the agency

        $invoice = $invoiceService->createInvoice($rentals, $client, $agency);

        return redirect()->route('clients.index')->with('success', 'Invoice generated successfully.');
    }


}
