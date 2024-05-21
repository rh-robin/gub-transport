<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class DriverProfileController extends Controller
{
    public function dashboard(){
        $driver = Auth::guard('driver')->user();
        return view('driver.dashboard', compact('driver'));
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
