<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id', 'name', 'model', 'type', 'status', 'availability'
    ];

    public function agency()
    {
        return $this->belongsTo(User::class, 'agency_id');
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
