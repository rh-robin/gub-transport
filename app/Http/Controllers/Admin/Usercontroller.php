<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class Usercontroller extends Controller
{
    public function view(){
        $users = User::all();
        return view("admin.user.user_view", compact('users'));
    }
}
