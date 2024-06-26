<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate',
        'availability',
        'agency_id',
        'model_id',
        'mechanical_state_id',
        'price',
        'tax_value'
    ];

    public function agency()
    {
        return $this->belongsTo(User::class);
    }

    public function model()
    {
        return $this->belongsTo(VehicleModel::class,'model_id');
    }

    public function mechanicalState()
    {
        return $this->hasOne(MechanicalState::class);
    }
}

