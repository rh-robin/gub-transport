<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function vehicleInRoutes()
    {
        return $this->hasMany(VehicleInRoute::class);
    }

    public function mainDeparture()
    {
        return $this->belongsTo(PickupArea::class, 'main_departure');
    }
}
