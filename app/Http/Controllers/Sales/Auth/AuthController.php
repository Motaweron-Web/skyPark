<?php

namespace App\Http\Controllers\Sales\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('logout');
    }

    public function view(){
        if (auth()->check()){
            return redirect('/sales');
        }
        return view('sales.auth.login');
    }//end fun
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){

        $data = $request->validate([
            'user_name'=>'required|exists:users',
            'password'=>'required'
        ]);


        if (auth()->attempt($data)){
            return response()->json(200);
        }
        return response()->json(405);
    }//end fun
    public function logout(){
        auth()->logout();
        toastr()->info('logged out successfully');
        return redirect('login');
    }//end fun

}//end class
