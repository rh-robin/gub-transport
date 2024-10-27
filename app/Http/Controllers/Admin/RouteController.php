<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Route;
use App\Models\PickupArea;
use App\Models\Vehicle;
use App\Models\VehicleInRoute;

use Illuminate\Validation\Rule;

class RouteController extends Controller
{
    public function view(){
        $routes = Route::with(['vehicleInRoutes.vehicle', 'mainDeparture'])->get();
        $vehicles = Vehicle::all();
        $areas = PickupArea::all();

        // For each route, find the vehicle with the lowest pickup time
        foreach ($routes as $route) {
            $route->pickupTime = $route->vehicleInRoutes->sortBy('pickup_time')->first();
        }

        return view('admin.route.route_view', compact('vehicles', 'areas', 'routes'));
    }
    public function add(){
        $vehicles = Vehicle::all();
        $areas = PickupArea::all();
        return view('admin.route.route_add', compact('vehicles', 'areas'));
    }

    public function store(Request $request){
        //dd($request->days[0]);
        $request->validate([
            'route_name' => 'required|unique:routes,route_name',
            'main_departure' => 'required',
            'vehicle_id' => 'required|array',
            'vehicle_id.*' => 'required',
            'pickup_area_id' => 'required|array',
            'pickup_area_id.*' => 'required',
            'pickup_time' => 'required|array',
            'pickup_time.*' => 'required',
            'arrive_time' => 'required',
            'arrive_time.*' => 'required',
            'days' => 'required',
            'days.*' => 'required',
        ],[
            'vehicle_id.*.required' => "The vehicle field is required",
            'pickup_area_id.*.required' => "The pickup field is required",
            'pickup_time.*.required' => "The pickup time field is required",
            'arrive_time.*.required' => "The arrive time field is required",
            'days.*.required' => "Please select the days",
        ]);
        //dd($request->all());
        $route = new Route();
        $route->route_name = $request->route_name;
        $route->main_departure = $request->main_departure;
        $route->instruction = $request->instruction;
        $route->save();

        $vehicleIDs = $request->vehicle_id;
        $pickupIDs = $request->pickup_area_id;
        $pickupTimes = $request->pickup_time;
        $arriveTimes = $request->arrive_time;

        $count = min(count($vehicleIDs), count($pickupIDs), count($pickupTimes), count($arriveTimes));
        for ($i = 0; $i < $count; $i++) {
            $routeVehicle = new VehicleInRoute();
            $routeVehicle->route_id = $route->id;
            $routeVehicle->vehicle_id = $vehicleIDs[$i];
            $routeVehicle->pickup_area_id = $pickupIDs[$i];
            $routeVehicle->pickup_time = $pickupTimes[$i];
            $routeVehicle->arrive_time = $arriveTimes[$i];
            $routeVehicle->days = $request->days[$i];
            $routeVehicle->save();
        }

        $notification = array(
            'message' => 'Route added Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->route('admin.route.view')->with($notification);

    }


    public function edit($id){
        $route = Route::findOrFail($id);
        $vehicles = Vehicle::all();
        $areas = PickupArea::all();
        $routeVehicles = VehicleInRoute::where('route_id', $id)->get();
        return view('admin.route.route_edit', compact('vehicles', 'areas', 'route', 'routeVehicles'));
    }



    public function update(Request $request, $id){
        //dd($request->all());
        $route = Route::findOrFail($id);
        $request->validate([
            'route_name' => [
                'required',
                Rule::unique('routes', 'route_name')->ignore($route->id),
            ],
            'main_departure' => 'required',
            'vehicle_id' => 'required|array',
            'vehicle_id.*' => 'required',
            'pickup_area_id' => 'required|array',
            'pickup_area_id.*' => 'required',
            'pickup_time' => 'required|array',
            'pickup_time.*' => 'required',
            'arrive_time' => 'required',
            'arrive_time.*' => 'required',
            'days' => 'required',
            'days.*' => 'required',
        ],[
            'vehicle_id.*.required' => "The vehicle field is required",
            'pickup_area_id.*.required' => "The pickup field is required",
            'pickup_time.*.required' => "The pickup time field is required",
            'arrive_time.*.required' => "The arrive time field is required",
            'days.*.required' => "Please select the days",
        ]);
        //dd($request->all());
        
        $route->route_name = $request->route_name;
        $route->main_departure = $request->main_departure;
        $route->instruction = $request->instruction;
        $route->update();

        $vehicleIDs = $request->vehicle_id;
        $pickupIDs = $request->pickup_area_id;
        $pickupTimes = $request->pickup_time;
        $arriveTimes = $request->arrive_time;
        $oldRouteVehicleIDs = $request->old_route_vehicle_id;

        $count2 = count($oldRouteVehicleIDs);
        $count = min(count($vehicleIDs), count($pickupIDs), count($pickupTimes), count($arriveTimes));
        foreach ($oldRouteVehicleIDs as $key => $oldRouteVehicleID) {
            $routeVehicle = VehicleInRoute::findOrFail($oldRouteVehicleID);
            $routeVehicle->route_id = $route->id;
            $routeVehicle->vehicle_id = $vehicleIDs[$key];
            $routeVehicle->pickup_area_id = $pickupIDs[$key];
            $routeVehicle->pickup_time = $pickupTimes[$key];
            $routeVehicle->arrive_time = $arriveTimes[$key];
            $routeVehicle->days = $request->days[$key];
            $routeVehicle->update();
        }
        for ($i = $count2; $i < $count; $i++) {
            
            $routeVehicle = new VehicleInRoute();
            
            $routeVehicle->route_id = $route->id;
            $routeVehicle->vehicle_id = $vehicleIDs[$i];
            $routeVehicle->pickup_area_id = $pickupIDs[$i];
            $routeVehicle->pickup_time = $pickupTimes[$i];
            $routeVehicle->arrive_time = $arriveTimes[$i];
            $routeVehicle->days = $request->days[$i];
            //dd($routeVehicle);
            $routeVehicle->save();
        }

        $notification = array(
            'message' => 'Route Updated Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);

    }


    public function availability(Request $request){
        $day = $request->checkboxValue; // Single day like 'monday'
        $pickupTime = $request->pickupTime;
        $arriveTime = $request->arriveTime;
        $vehicleID = $request->vehicleID;

        // Query to find available vehicles based on the specified criteria
        $vehicles = VehicleInRoute::where('vehicle_id', $vehicleID)
        ->whereRaw("FIND_IN_SET(?, days)", [$day])
        ->where(function ($query) use ($pickupTime, $arriveTime) {
            $query->where(function ($subQuery) use ($pickupTime, $arriveTime) {
                $subQuery->where('pickup_time', '<=', $pickupTime)
                         ->where('arrive_time', '>', $pickupTime);
            })->orWhere(function ($subQuery) use ($pickupTime, $arriveTime) {
                $subQuery->where('pickup_time', '<', $arriveTime)
                         ->where('arrive_time', '>=', $arriveTime);
            })->orWhere(function ($subQuery) use ($pickupTime, $arriveTime) {
                $subQuery->where('pickup_time', '>', $pickupTime)
                         ->where('arrive_time', '<=', $arriveTime);
            });
        })
        ->get();
        $vehiclesCount = $vehicles->count();
        return response()->json($vehiclesCount);
    }


    public function delete($id){
        $route = Route::findOrFail($id);
        $route->delete();

        $notification = array(
            'message' => 'Route Deleted Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }
}
