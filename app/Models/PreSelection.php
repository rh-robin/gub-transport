<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreSelection extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function vehicleInRoute()
    {
        return $this->belongsTo(VehicleInRoute::class, 'route_vehicle_id');
    }
}
