<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MechanicalState extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_oil_change', 
        'mileage', 
        'tire_condition', 
        'brake_condition', 
        'engine_condition', 
        'technical_inspection', 
        'technical_inspection_comment', 
        'comment',
        'vehicle_id',
        'last_tax_pay',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}