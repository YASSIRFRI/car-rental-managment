<?php

namespace App\Rules;

use App\Models\Vehicle;
use Illuminate\Contracts\Validation\Rule;

class AvailableVehicle implements Rule
{
    public function passes($attribute, $value)
    {
        return Vehicle::where('id', $value)->where('availability', true)->exists();
    }

    public function message()
    {
        return 'The selected vehicle is not available.';
    }
}
