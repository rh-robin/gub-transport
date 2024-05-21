<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Vehicle;
use App\Models\Driver;

use Illuminate\Validation\Rule;

class VehicleController extends Controller
{
    public function view(){
        $vehicles = Vehicle::latest()->get();
        $drivers = Driver::all();
        //dd($vehicles);
        return view('admin.vehicle.vehicle_view', compact('vehicles', 'drivers'));
    }

    public function store(Request $request){
        //dd($request->all());
        $request->validate([
            'serial_number' => 'required|unique:vehicles,serial_number',
            'vehicle_number' => 'required|unique:vehicles,vehicle_number',
            'image' => 'mimes:jpg,png,jpeg',
        ]);

        $vehicle = new Vehicle();
        $vehicle->serial_number = $request->serial_number;
        $vehicle->vehicle_number = $request->vehicle_number;
        $vehicle->driver_id = $request->driver_id;
        $vehicle->description = $request->description;

        if($request->file('image')){
            $img = $request->file('image');
            $img_name = hexdec(uniqid()) .'.'. $request->file('image')->getClientOriginalExtension();
            $img_url = 'upload/vehicle_images/'.$img_name;
            $img->move(public_path('upload/vehicle_images'), $img_name);
            $vehicle->image = $img_url;
        }
        $vehicle->save();

        $notification = array(
            'message' => 'Vehicle added Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function edit($id){
        $vehicle = Vehicle::findOrFail($id);
        $drivers = Driver::all();
        return view('admin.vehicle.vehicle_edit', compact('vehicle', 'drivers'));
    }


    public function update(Request $request, $id){
        $vehicle = Vehicle::findOrFail($id);
        //dd($request->all());
        $request->validate([
            'serial_number' => [
                'required',
                Rule::unique('vehicles', 'serial_number')->ignore($vehicle->id),
            ],
            'vehicle_number' => [
                'required',
                Rule::unique('vehicles', 'vehicle_number')->ignore($vehicle->id),
            ],
            'image' => 'mimes:jpg,png,jpeg',
        ]);

        
        $vehicle->serial_number = $request->serial_number;
        $vehicle->vehicle_number = $request->vehicle_number;
        $vehicle->driver_id = $request->driver_id;
        $vehicle->description = $request->description;

        if($request->file('image')){
            if($vehicle->image){
                unlink($vehicle->image);
            }
            $img = $request->file('image');
            $img_name = hexdec(uniqid()) .'.'. $request->file('image')->getClientOriginalExtension();
            $img_url = 'upload/vehicle_images/'.$img_name;
            $img->move(public_path('upload/vehicle_images'), $img_name);
            $vehicle->image = $img_url;
        }
        $vehicle->save();

        $notification = array(
            'message' => 'Vehicle updated Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function delete($id){
        $vehicle = Vehicle::findOrFail($id);
        if($vehicle->image){
            unlink($vehicle->image);
        }
        $vehicle->delete();

        $notification = array(
            'message' => 'Vehicle deleted Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }
}
