<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Route;
use App\Models\PickupArea;
use App\Models\RouteAllPickup;
use App\Models\Vehicle;
use App\Models\VehicleInRoute;

class RouteController extends Controller
{
    public function add(){
        $vehicles = Vehicle::all();
        $areas = PickupArea::all();
        return view('admin.route.route_add', compact('vehicles', 'areas'));
    }
}
