<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getAgencies()
    {
        $agencies = User::where('role', 'agency')
            ->whereHas('vehicles', function($query) {
                $query->where('availability', true);
            })
            ->with(['vehicles' => function($query) {
                $query->where('availability', true)->with('model');
            }])
            ->get();

        return response()->json($agencies);
    }

    public function getCarsForAgency($agencyId)
    {
        $agency = User::where('role', 'agency')->findOrFail($agencyId);
        $availableCars = $agency->vehicles()
            ->where('availability', true)
            ->with('model')
            ->get();

        return response()->json($availableCars);
    }
}
