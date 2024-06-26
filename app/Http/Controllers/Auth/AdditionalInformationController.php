<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdditionalInformationController extends Controller
{
    public function show()
    {
        return view('auth.additional-information');
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
        ]);

        $user = Auth::user();
        $user->address = $request->address;
        $user->city = $request->city;
        $user->zip_code = $request->zip_code;
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Additional information saved successfully.');
    }
}
