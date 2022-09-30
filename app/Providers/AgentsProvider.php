<?php

namespace App\Providers;

use App\Models\Oders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AgentsProvider extends ServiceProvider
{
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
            $ordertodaysummine=Oders::WHERE([['order_type','regional'],['center',$usercenter],
            ['oder_status','!=','cancelled']])->whereDate('created_at',DB::raw('CURDATE()'))->sum('value');
            $ordertodaysum=Oders::WHERE([['order_type','regional'],['desination',$usercenter],
            ['oder_status','!=','cancelled']])->whereDate('created_at',DB::raw('CURDATE()'))->sum('value');
            $agents->with('ordertoday', $ordertodaycout);
            $agents->with('sumtodaymine', $ordertodaysummine);
            $agents->with('sumtoday', $ordertodaysum);
            #This month
            $ordermonthlycout=Oders::WHERE([['order_type','regional'],['center',$usercenter]])
            ->whereMonth('created_at',date('m'))->count();
            $ordermonthlysummine=Oders::WHERE([['order_type','regional'],['center',$usercenter],
            ['oder_status','!=','cancelled']])->whereMonth('created_at',date('m'))->sum('value');
            $ordermonthlysum=Oders::WHERE([['order_type','regional'],['desination',$usercenter],
            ['oder_status','!=','cancelled']])->whereMonth('created_at',date('m'))->sum('value');
            $agents->with('ordermonth', $ordermonthlycout);
            $agents->with('summonthmine', $ordermonthlysummine);
            $agents->with('summonth', $ordermonthlysum);
            #all orders
            $sourceordercout=Oders::WHERE([['order_type','regional'],['center',$usercenter]])->count();
            $desinationeordercout=Oders::WHERE([['order_type','regional'],['desination',$usercenter]])->count();
            $agents->with('sourceordercount', $sourceordercout);
            $agents->with('desinationordercount', $desinationeordercout);
        });
    }
}
