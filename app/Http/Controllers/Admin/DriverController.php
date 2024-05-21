<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Driver;

use Hash;
use Illuminate\Validation\Rule;

class DriverController extends Controller
{
    public function view(){
        $drivers = Driver::latest()->get();
        //dd($drivers);
        return view('admin.driver.driver_view', compact('drivers'));
    }

    public function store(Request $request){
        //dd($request->all());
        $request->validate([
            'gub_id' => 'required|unique:drivers,gub_id',
            'name' => 'required',
            'phone' => 'required',
            'license_no' => [
                Rule::unique('drivers', 'license_no')->where(function ($query) {
                    return $query->whereNotNull('license_no');
                }),
            ],
            'image' => 'mimes:jpg,png,jpeg',
            'license_image' => 'mimes:jpg,png,jpeg',
        ]);

        $driver = new Driver();
        $driver->gub_id = $request->gub_id;
        $driver->name = $request->name;
        $driver->phone = $request->phone;
        $driver->email = $request->email;
        $driver->license_no = $request->license_no;
        $driver->address = $request->address;
        $driver->password = Hash::make('12345678');

        if($request->file('image')){
            $img = $request->file('image');
            $img_name = hexdec(uniqid()) .'.'. $request->file('image')->getClientOriginalExtension();
            $img_url = 'upload/driver_images/'.$img_name;
            $img->move(public_path('upload/driver_images'), $img_name);
            $driver->image = $img_url;
        }
        if($request->file('license_image')){
            $img = $request->file('license_image');
            $img_name = hexdec(uniqid()) .'.'. $request->file('license_image')->getClientOriginalExtension();
            $img_url = 'upload/license_images/'.$img_name;
            $img->move(public_path('upload/license_images'), $img_name);
            $driver->license_image = $img_url;
        }
        $driver->save();

        $notification = array(
            'message' => 'Driver added Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function edit($id){
        $driver = Driver::findOrFail($id);
        return view('admin.driver.driver_edit', compact('driver'));
    }


    public function update(Request $request, $id){
        $driver = Driver::findOrFail($id);
        $request->validate([
            'gub_id' => [
                'required',
                Rule::unique('drivers', 'gub_id')->ignore($driver->id),
            ],
            'name' => 'required',
            'phone' => 'required',
            'license_no' => [
                Rule::unique('drivers', 'license_no')->ignore($driver->id),
            ],
            'image' => 'nullable|mimes:jpg,png,jpeg',
            'license_image' => 'nullable|mimes:jpg,png,jpeg',
        ]);

        
        $driver->gub_id = $request->gub_id;
        $driver->name = $request->name;
        $driver->phone = $request->phone;
        $driver->email = $request->email;
        $driver->license_no = $request->license_no;
        $driver->address = $request->address;
        $driver->password = Hash::make('12345678');

        if($request->file('image')){
            if($driver->image){
                unlink($driver->image);
            }
            $img = $request->file('image');
            $img_name = hexdec(uniqid()) .'.'. $request->file('image')->getClientOriginalExtension();
            $img_url = 'upload/driver_images/'.$img_name;
            $img->move(public_path('upload/driver_images'), $img_name);
            $driver->image = $img_url;
        }
        if($request->file('license_image')){
            if($driver->license_image){
                unlink($driver->license_image);
            }
            $img = $request->file('license_image');
            $img_name = hexdec(uniqid()) .'.'. $request->file('license_image')->getClientOriginalExtension();
            $img_url = 'upload/license_images/'.$img_name;
            $img->move(public_path('upload/license_images'), $img_name);
            $driver->license_image = $img_url;
        }
        $driver->save();

        $notification = array(
            'message' => 'Driver updated Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function delete($id){
        $driver = Driver::findOrFail($id);
        if($driver->image){
            unlink($driver->image);
        }
        if($driver->license_image){
            unlink($driver->license_image);
        }
        $driver->delete();

        $notification = array(
            'message' => 'Driver deleted Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }
}
