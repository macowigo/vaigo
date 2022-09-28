<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with([
            'logout'=>'You are Successfully logged out',
            'failed','Sorry you are no allowed to access any thing rightnow'
        ]);
    }
    public function notauthenticated(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('failed','Sorry you are not allowed to access any thing right now');
    }
}
