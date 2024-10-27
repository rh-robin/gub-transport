<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleInRoute extends Model
{
    use HasFactory;
    protected $guarded = [];


     // Define the relationship with Route
     public function route()
     {
         return $this->belongsTo(Route::class);
     }


     // Define the relationship with Vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Define the relationship with PickupArea 
    public function pickupArea()
    {
        return $this->belongsTo(PickupArea::class);
    }

    public function preSelections()
    {
        return $this->hasMany(PreSelection::class, 'route_vehicle_id');
    }


    
}
