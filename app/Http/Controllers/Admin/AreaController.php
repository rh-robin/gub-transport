<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PickupArea;

class AreaController extends Controller
{
    public function view(){
        $areas = PickupArea::all();
        //dd($vehicles);
        return view('admin.area.area_view', compact('areas'));
    }


    public function store(Request $request){
        $request->validate([
            'area_name' => 'required',
            'pickup_point' => 'required',
        ]);

        $area = new PickupArea();
        $area->area_name = $request->area_name;
        $area->pickup_point = $request->pickup_point;

        $area->save();

        $notification = array(
            'message' => 'Pickup area added Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function edit($id){
        $area = PickupArea::findOrFail($id);
        //dd($vehicles);
        return view('admin.area.area_edit', compact('area'));
    }


    public function update(Request $request, $id){
        $area = PickupArea::findOrFail($id);
        $request->validate([
            'area_name' => 'required',
            'pickup_point' => 'required',
        ]);

        $area->area_name = $request->area_name;
        $area->pickup_point = $request->pickup_point;

        $area->save();

        $notification = array(
            'message' => 'Pickup area updated Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }
}
