<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\Route;
use App\Models\PickupArea;
use App\Models\Vehicle;
use App\Models\VehicleInRoute;
use App\Models\Driver;

class DriverProfileController extends Controller
{
    public function dashboard(){
        $driver = Auth::guard('driver')->user();

        $vehicles = Vehicle::where('driver_id', $driver->id)->get();
        $vehicleIds = $vehicles->pluck('id');
        $routeVehicles = VehicleInRoute::with('route')
                                    ->whereIn('vehicle_id', $vehicleIds)
                                    ->get();

        // Extract the routes from the routeVehicles
        $routes = $routeVehicles->map(function ($routeVehicle) {
            return $routeVehicle->route;
        })->unique('id');
        
        
        return view('driver.dashboard', compact('driver', 'routes', 'vehicles', 'routeVehicles'));
    }

    public function login(){
        return view('driver.login');
    }

    public function login_submit(Request $request){
        //dd($request->all());
        $request->validate([
            "gub_id" => "required",
            "password" => "required"
        ]);

        $check = $request->all();
        $data = [
            "gub_id" => $check["gub_id"],
            "password" => $check["password"],
        ];

        if(Auth::guard('driver')->attempt($data)){
            return redirect()->route("driver.dashboard")->with("success", "Login Successfull");
        }else{
            return redirect()->route("driver.login")->with("error", "Invalid credentials");
        }

    }


    public function logout(){
        Auth::guard('driver')->logout();
        return redirect()->route("driver.login")->with("success", "Logout Successfull");
    }


    public function profile(){
        $driver = Auth::guard('driver')->user();
        return view('driver.profile', compact('driver'));
    }

}
