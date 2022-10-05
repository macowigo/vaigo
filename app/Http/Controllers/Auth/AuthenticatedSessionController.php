<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Api\SmsController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('welcome');
    }
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('logout','You are Successfully logged out');
    }
    public function notauthenticated(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('failed','Sorry you are not allowed to access any thing right now');
    }

    public function forgotview()
    {
        return view('forgotpass');
    }
    public function sendtoken(Request $request)
    {
        $request->validate(['email'=>'required']);
        $checkemail=User::WHERE('email',$request->email)->first();
        if($checkemail){
            Auth::login($checkemail);
            $code=random_int(1000,99999);
            DB::table('password_resets')->insert([
              'email'=>$request->email,
              'token'=>$code
            ]);
            $tosend="Password recovery code is $code";
            SmsController::sendsms($tosend,substr_replace(Auth::user()->phone, '255', 0, 1));
            return redirect()->route('verifytoken')->with('success','enter recovery code sent');

        }
        else{
            return redirect()->back()->with('failed','Sorry email is not correct');
        }
    }
    public function verifyview()
    {
        return view('verifytoken');
    }
    public function verifycode(Request $request)
    {
        $request->validate(['code'=>'required']);
        $chekcode=DB::table('password_resets')->WHERE(['email'=>Auth::user()->email,
               'token'=>$request->code])->first();
        if($chekcode){
            DB::table('password_resets')->WHERE('email',Auth::user()->email)->delete();
            return redirect()->route('changepassword')->with('success','code verified successfully');
        }
        else{
            return redirect()->back()->with('failed','Sorry recovery code you entered is not correct');
        }
    }
    public function changepassview()
    {
        return view('changepassword');
    }
    public function changepassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

            $upadatepassword=User::WHERE('id',Auth::user()->id)
            ->update(['password'=>Hash::make($request->password)]);
            if($upadatepassword){
                return redirect('redirect')->with('success','Your Password Successfully Changed Please login');
            }
            else{
                return redirect()->back()->with('failed','Sorry Your Password Changes Failed');
            }
      
    }
}
