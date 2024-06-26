<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 
        'name', 
        'constructor', 
        'image', 
        'number_of_seats', 
        'horsepower', 
        'top_speed', 
        'price', 
        'year', 
        'fuel_type', 
        'transmission', 
        'drive_train', 
        'fuel_consumption', 
        'trunk_size'
    ];
}
