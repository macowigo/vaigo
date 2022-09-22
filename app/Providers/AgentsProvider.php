<?php

namespace App\Providers;

use App\Models\Oders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AgentsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    public function boot()
    {
        View::composer('agents.*', function ($agents) {
            $usercenter=Auth::user()->centerid;
           #today
           $ordertodaycout=Oders::WHERE([['order_type','regional'],['center',$usercenter]])
            ->whereDate('created_at',DB::raw('CURDATE()'))->count();
            $agents->with('ordertoday', $ordertodaycout);
            #This month
            $ordermonthlycout=Oders::WHERE([['order_type','regional'],['center',$usercenter]])
            ->whereMonth('created_at',date('m'))->count();
            $agents->with('ordermonth', $ordermonthlycout);
            #all orders
            $ordercout=Oders::WHERE([['order_type','regional'],['center',$usercenter]])->count();
            $agents->with('ordercount', $ordercout);
        });
    }
}
