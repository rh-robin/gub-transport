<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\Route;
use App\Models\PickupArea;
use App\Models\Vehicle;
use App\Models\VehicleInRoute;
use App\Models\PreSelection;
use App\Models\RequestedSlot;
use App\Models\UserSiteSetting;

use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    /* public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    } */

    /**
     * Delete the user's account.
     */
    /* public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    } */


    /* profile data edit page */
    public function profileView(){
        $user = Auth::user();
        return view('user.profile_view', compact('user'));
    }

    public function profileSubmit(Request $request){
        $request->validate([
            'image' => 'mimes:png,jpg,jpeg',
            'email' => 'required|email',
        ]);
        $user = Auth::user();
        $user->phone = $request->phone;
        $user->email = $request->email;
        if($request->file('image')){
            if($user->image){
                unlink($user->image);
            }
            $img = $request->file('image');
            $img_name = hexdec(uniqid()) .'.'. $request->file('image')->getClientOriginalExtension();
            $img_url = 'upload/user_images/'.$img_name;
            $img->move(public_path('upload/user_images'), $img_name);
            $user->image = $img_url;
        }
        $user->save();
        $notification = array(
            'message' => 'Data Updated Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }



    public function routeView($id){
        $route = Route::findOrFail($id);
        $vehicles = Vehicle::all();
        $areas = PickupArea::all();
        $routeVehicles = VehicleInRoute::where('route_id', $id)->get();
        return view('user.route_view', compact('vehicles', 'areas', 'route', 'routeVehicles'));
    }


    public function preSelection(){
        $userSiteSetting = UserSiteSetting::first();
        if($userSiteSetting->preselection == "off"){
            $msg = "Pre-selection is closed. Please contact with your advisor.";
            return view('user.preselection', compact('msg'));
        }
        $user = Auth::user();
        $preSelection = PreSelection::where('user_id', $user->id)->first();
        //dd($preSelection);
        if($preSelection === null){
            $routes = Route::all();
            $distinctCombinations = VehicleInRoute::select('route_id', 'pickup_area_id', 'pickup_time', 'days', DB::raw('MIN(id) as id'))
                ->groupBy('route_id', 'pickup_area_id', 'pickup_time', 'days')
                ->get();

            $ids = $distinctCombinations->pluck('id');

            $routeVehicles = VehicleInRoute::whereIn('id', $ids)->get();
            return view('user.preselection', compact('routes','routeVehicles'));
        }else{
            $msg = "Your Pre-selection is already done";
            return view('user.preselection', compact('msg'));
        }
        
    }

    public function preSelectionSubmit(Request $request){
        //dd($request->all());
        /* $request->validate([
            'route_vehicle_id' => 'required|array',
            'route_vehicle_id.*' => 'required',
        ],[
            'route_vehicle_id.required' => 'Please select at least one route'
        ]); */
        $msg = "";
        $user = Auth::user();
        if($request->route_vehicle_id){
            $routeVehicleIDs = $request->route_vehicle_id;
            
            foreach ($routeVehicleIDs as $routeVehicleID) {
                $preSelection = new PreSelection();
                $preSelection->user_id = $user->id;
                $preSelection->route_vehicle_id = $routeVehicleID;
                $preSelection->save();
                $msg = "Selection Submitted";
            }
        }else{
            $msg = "You did not select any route";
        }
        $isAnyNull = false;
        $pickupPoints = $request->pickup_point;
        $classTimes = $request->class_time;
        $days = $request->days;

        // Check pickupPoints array
        foreach ($pickupPoints as $pickupPoint) {
            if ($pickupPoint === null) {
                $isAnyNull = true;
                break;
            }
        }

        // Check classTimes array
        foreach ($classTimes as $classTime) {
            if ($classTime === null) {
                $isAnyNull = true;
                break;
            }
        }

        // Check days array
        foreach ($days as $day) {
            if ($day === null) {
                $isAnyNull = true;
                break;
            }
        }

        if ($isAnyNull) {
            $msg .= ". And did not make any request";
        } else {
            $i=0;
            foreach ($pickupPoints as $pickupPoint) {
                $slot = new RequestedSlot();
                $slot->user_id = $user->id;
                $slot->pickup_point = $pickupPoint;
                $slot->class_time = $classTimes[$i];
                $slot->days = $days[$i];
                $slot->save();
                $i++;
            }
            $msg .= ". Request Submitted";
        }
        
        
        

        if($msg !=""){
            $notification = array(
                'message' => $msg ,
                'alert-type'=> 'info'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => "Failed" ,
                'alert-type'=> 'info'
            );
            return redirect()->back()->with($notification);
        }
    }


    public function findVehicle(){
        $areas = PickupArea::all();
        return view('user.find_vehicle', compact('areas'));
    }

    public function findVehicleSubmit(Request $request){
        $request->validate([
            'pickup' => 'required',
            'day' => 'required'
        ]);
        $routeVehicles = VehicleInRoute::where('pickup_area_id', $request->pickup)
        ->whereRaw('FIND_IN_SET(?, days)', [$request->day])
        ->get();
        $areas = PickupArea::all();
        //dd($routeVehicles->count());
        return view('user.find_vehicle', compact('areas', 'routeVehicles'));
    }
}
