<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLogin extends Controller
{
    function login(Request $request){
        $credential=$request->all();
        if(Auth::attempt($credential)){
            $request->session()->regenerate();
            return ['attemp'=>'good'];
        }
        return['attemp'=>'invalid credentials'];
    }
}
