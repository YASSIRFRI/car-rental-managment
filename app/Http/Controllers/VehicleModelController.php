<?php

namespace App\Http\Controllers;

use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleModelController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $vehicleModels = VehicleModel::where('name', 'LIKE', "%{$query}%")->get();
        return response()->json($vehicleModels);
    }
}

