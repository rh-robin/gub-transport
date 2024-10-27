<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/* use App\Models\Route;
use App\Models\PickupArea;
use App\Models\Vehicle;
use App\Models\VehicleInRoute; */
use App\Models\PreSelection;
use App\Models\RequestedSlot;
use App\Models\UserSiteSetting;

use Illuminate\Support\Facades\DB;

class PreSelectionController extends Controller
{
    public function selectionView(){
        /* $preSelections = PreSelection::all(); */
        $userSiteSetting = UserSiteSetting::first();

        $subquery = PreSelection::select('route_vehicle_id', DB::raw('MIN(id) as id'))
            ->groupBy('route_vehicle_id');

        $preSelections = PreSelection::joinSub($subquery, 'sub', function($join) {
                $join->on('pre_selections.id', '=', 'sub.id');
            })
            ->select('pre_selections.*')
            ->get();
        foreach ($preSelections as $preSelection) {
            $preSelection->numberOfUser = PreSelection::where('route_vehicle_id', $preSelection->route_vehicle_id)->count();
        }
        //dd($preSelections);
        return view('admin.preselection.selection_view', compact('preSelections', 'userSiteSetting'));
    }

    public function requestView(){
        /* $allRequest = RequestedSlot::all(); */
        
        $allRequest = RequestedSlot::select('pickup_point', 'class_time', 'days')
        ->groupBy('pickup_point', 'class_time', 'days')
        ->get();
            
        foreach ($allRequest as $request) {
            $request->numberOfUsers = RequestedSlot::where('pickup_point', $request->pickup_point)
            ->where('class_time', $request->class_time)
            ->where('days', $request->days)
            ->count('user_id');
        }
        
        return view('admin.preselection.request_view', compact('allRequest'));
    }

    public function selectionOnOff(){
        $userSiteSetting = UserSiteSetting::first();
        if($userSiteSetting->preselection == "on"){
            $userSiteSetting->preselection = "off";
        }else{
            $userSiteSetting->preselection = "on";
        }
        $userSiteSetting->update();
        return response()->json("changed");
    }
}
