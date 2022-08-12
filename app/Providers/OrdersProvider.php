<?php

namespace App\Providers;

use App\Models\Oders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class OrdersProvider extends ServiceProvider
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

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($centers) {
            $usercenter=Auth::user()->centerid;
            $today=date('Y-m-d');
            $domesticcout=Oders::WHERE([['order_type','domestic'],['center',$usercenter]])->count();
            $reginalcount=Oders::WHERE([['order_type','regional'],['center',$usercenter]])->count();
            $internationalcount=Oders::WHERE([['order_type','international'],['center',$usercenter]])->count();
           //today

           $domestictodaycout=Oders::WHERE([
            ['order_type','domestic'],['center',$usercenter],['created_date',$today]])->count();
           $reginaltodaycount=Oders::WHERE([
            ['order_type','regional'],['center',$usercenter],['created_date',$today]])->count();
            $internationaltodaycount=Oders::WHERE([
             ['order_type','international'],['center',$usercenter],['created_date',$today]])->count();

            $centers->with('domestic', $domesticcout);
            $centers->with('regional', $reginalcount);
            $centers->with('international', $internationalcount);
            //today view
            $centers->with('domestictoday', $domestictodaycout);
            $centers->with('regionaltoday', $reginaltodaycount);
            $centers->with('internationaltoday', $internationaltodaycount);
            //composer with chache
            // $counts = Cache::remember('counts', 60, function() {
            //     return ['domestic'=>Oders::WHERE('order_type','domestic')->count(),
            //     'regional'=>Oders::WHERE('order_type','regional')->count(),
            //     'international'=>Oders::WHERE('order_type','international')->count()];  
            // });
            // return $view->with('counts', $counts);
        });
        //
    }
}
