<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Payment;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch all vehicles and rentals
        $id=Auth::user()->id;
        $vehicles = Vehicle::with(['model', 'mechanicalState'])
            ->where('agency_id', $id)
            ->get();
        $rentals = Rental::with(['vehicle.model', 'client'])->get();
        $payments = Payment::selectRaw('SUM(amount) as total, MONTH(date_of_payment) as month')
                            ->groupBy('month')
                            ->pluck('total', 'month');

        // Calculate fleet rotation rate
        $availableVehicles = $vehicles->where('agency_id', $id)->where('availability', 1);
        $availableVehiclescount = $availableVehicles->count();
        $rentedVehicles = $vehicles->where('availability', 0);
        $rentedVehiclescount= $rentedVehicles->count();
        $unavailableVehicles = $vehicles->count() - $availableVehiclescount - $rentedVehiclescount;

        // Cars available today
        $today = Carbon::today();
        $availableToday = Rental::with('vehicle.model')
                                ->where('end_date', $today)
                                ->get();

        // Cars with mechanical issues
        $carsWithIssues = Vehicle::whereHas('mechanicalState', function($query) {
            $query->where('mileage', '>', 100000)
                  ->orWhere('last_oil_change', '<', Carbon::now()->subMonths(6))
                  ->orWhere('technical_inspection', '<', Carbon::now()->subMonths(12))
                  ->orWhere('technical_inspection_comment', '!=', null);
        })->get();

        return view('dashboard', compact('vehicles', 'rentals', 'availableVehicles', 'rentedVehicles', 'unavailableVehicles', 'payments', 'availableToday', 'carsWithIssues'));
    }
}
