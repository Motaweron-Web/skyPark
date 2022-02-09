<?php

namespace App\Http\Controllers\Sales\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function view(){
        return view('sales.auth.login');
    }//end fun

    public function login(Request $request){
        $data = $request->validate([
            'user_name'=>'required|exists:users',
            'password'=>'required'
        ]);


        if (auth()->attempt($data)){
            return response()->json(200);
        }
        return response()->json(405);

    }
}//end class
