<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\Admin;
use App\Mail\WebsiteMail;


use App\Models\Route;
use App\Models\PickupArea;
use App\Models\Vehicle;
use App\Models\VehicleInRoute;
use App\Models\Driver;
use App\Models\RequestedSlot;

class AdminController extends Controller
{
    public function dashboard(){
        $numberOfRoutes = Route::count();
        $numberOfVehicles = Vehicle::count();
        $numberOfDrivers = Driver::count();
        $numberOfRequest = RequestedSlot::select('pickup_point', 'class_time', 'days')->groupBy('pickup_point', 'class_time', 'days')->get()->count();
        return view('admin.index', compact('numberOfRoutes', 'numberOfVehicles', 'numberOfDrivers', 'numberOfRequest'));
    }

    public function login(){
        return view('admin.login');
    }

    public function login_submit(Request $request){
        //dd($request->all());
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $check = $request->all();
        $data = [
            "email" => $check["email"],
            "password" => $check["password"],
        ];

        if(Auth::guard('admin')->attempt($data)){
            return redirect()->route("admin.dashboard")->with("success", "Login Successfull");
        }else{
            return redirect()->route("admin.login")->with("error", "Invalid credentials");
        }

    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route("admin.login")->with("success", "Logout Successfull");
    }

    public function forgetPassword(){
        return view('admin.forget_password');
    }

    public function forgetPassword_submit(Request $request){
        $request->validate([
            "email" => "required|email"
        ]);

        $adminData = Admin::where("email",$request->email)->first();
        if(!$adminData){
            return redirect()->route("admin.forgetPassword")->with("error", "Email not found");
        }else{
            $token = hash("sha256", time());
            $adminData->token = $token;
            $adminData->update();

            $resetLink = url('admin/reset-password/'.$token.'/'.$request->email);

            $subject = "Reset Password";
            $message = "Please click on the link below. <br><br>";
            $message .= "<a href=".$resetLink.">Reset Password</a>";

            \Mail::to($request->email)->send(new WebsiteMail($subject, $message));
            return redirect()->back()->with("success", "Password reset link sent to your email");
        }
    }

    public function resetPassword($token, $email){
        $adminData = Admin::where("email", $email)->where("token", $token)->first();
        if(!$adminData){
            return redirect()->route("admin.forgetPassword")->with("error", "Invalid token or email. Try again");
        }
        return view("admin.reset_password", compact("token", "email"));
    }

    public function resetPassword_submit(Request $request){
        $request->validate([
            "password" => "required",
            "password_confirmation" => "required|same:password"
        ]);

        $adminData = Admin::where("email", $request->email)->where("token", $request->token)->first();
        $adminData->password = Hash::make($request->password);
        $adminData->token = "";
        $adminData->update();
        return redirect()->route("admin.login")->with("success", "Password reset successfully");
    }
}
