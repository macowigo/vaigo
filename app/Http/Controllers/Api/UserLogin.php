<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserLogin extends Controller
{
    public function login(Request $request){
        $phone = $request->phone;
        $password = $request->password;
        $user = User::WHERE('phone', $request->phone)->first();
        if ($user){
        if(Hash::check($request->password, $user->password))
        {
             $token = $user->createToken("MyToken")->plainTextToken;
             $response = ['status' => true, 'token' => $token, 'user' => $user, 'message' => 'login successful'];
        }
        else{
            $response = ['status' => false, 'message' =>'incorrect password'];
        } 
    }
    else{
        $response = ['status' => false, 'message' => 'incorrect phone number'];
    }
            return $response;
        
    }
}
