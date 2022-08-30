<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$role)
    {
        if(Auth::user()->role==$role){
            return $next($request);
        }
        else{
            if(Auth::user()->role=="admin"){
                return  redirect()->route('admindshboard');
            }
            elseif(Auth::user()->role=="depature"){
                return  redirect()->route('dptdashboard');
            }
            elseif(Auth::user()->role=="center"){
                return  redirect()->route('centerdashboard');
            }
            else{
                return  redirect()->route('/');
            }
        }
        
    }
}
