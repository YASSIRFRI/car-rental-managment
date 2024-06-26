<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'phone', 'email', 'agency_id', 'type', 'ice', 'cin', 'address', 'city'
    ];
}
