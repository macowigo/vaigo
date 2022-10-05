<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class RedirectController extends Controller
{
    public function index(){
        $userrole=Auth::User()->role;
        if($userrole=="admin"){
            return redirect('/admin/dashboard');
        }
        elseif($userrole=="depaturer"){
            return redirect('/depaturer/dashboard'); 
        }
        elseif($userrole=="center"){
            return redirect('/center/dashboard'); 
        }
        elseif($userrole=="agent"){
            return redirect('/agent/dashboard'); 
        }
       
        else{
            return redirect()->route('notauth');
        }

    }
}
