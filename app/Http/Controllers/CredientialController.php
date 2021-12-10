<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Accountant;


class CredientialController extends Controller
{
    public function authenticate(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);
        
        if($request->role == 'admin'){
            $user = User::where("email", $request->email)->first();
            if(!$user || !Hash::check($request->password, $user->password)){
                return back()->with("login_failed", "E-Mail or password does not exists!"); 
            }
            $request->session()->put("user", $user);
            return redirect()->route("admin");

        }elseif($request->role == 'accountant'){
            $user = Accountant::where("email", $request->email)->first();
            if(!$user || !Hash::check($request->password, $user->password)){
                return back()->with("login_failed", "E-Mail or password does not exists!"); 
            }
            $request->session()->put("user", $user);
            return redirect()->route("accountant");
        }
        // elseif($request->role == 'invester'){
        //     $user = User::where("email", $request->email)->first();
        //     if(!$user || !Hash::check($request->password, $user->password)){
        //         return back()->with("login_failed", "E-Mail or password does not exists!"); 
        //     }
        // }

        
    }
}
