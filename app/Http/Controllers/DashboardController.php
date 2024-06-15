<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $agencyId = Auth::id();
        $vehicles = Vehicle::where('agency_id', $agencyId)->get();
        $rentals = Rental::whereHas('vehicle', function($query) use ($agencyId) {
            $query->where('agency_id', $agencyId);
        })->get();
        return view('dashboard', compact('vehicles', 'rentals'));
    }
}
