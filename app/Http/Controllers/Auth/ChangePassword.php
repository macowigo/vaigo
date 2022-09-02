<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Controller
{
    public function changepassword(Request $request)
    {
        $request->validate([
            'oldpassword'=>'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if(Hash::check($request->oldpassword,Auth::user()->password)){
            $upadatepassword=User::WHERE('id',Auth::user()->id)
            ->update(['password'=>Hash::make($request->password)]);
            if($upadatepassword){
                return redirect()->route('ondoka')->with('success','Your Password Successfully Changed Please login');
            }
            else{
                return redirect()->back()->with('failed','Sorry Your Password Changes Failed');
            }
        }
        else{
            return redirect()->back()->with('failed','Sorry your Current Password is not Correct');
        }
    }
}
