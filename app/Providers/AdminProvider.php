<?php

namespace App\Providers;

use App\Models\Centers;
use App\Models\Oders;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AdminProvider extends ServiceProvider
{
    public function register()
    {
        //
    }
    public function boot()
    {
        View::composer('admin.*', function ($admin) {
            $centercount=Centers::WHERE('type','center')->count();
            $vendorcount=User::WHERE('role','vendor')->count();
            $agentcount=User::WHERE('role','agent')->count();
            $domestictodaycout=Oders::WHERE('order_type','domestic')->whereDate('created_at',DB::raw('CURDATE()'))->count();
            $regionaltodaycout=Oders::WHERE('order_type','regional')->whereDate('created_at',DB::raw('CURDATE()'))->count();
            $domesticcout=Oders::WHERE([['order_type','domestic']])->count();
            $reginalcount=Oders::WHERE([['order_type','regional']])->count();
            $admin->with('centers', $centercount);
            $admin->with('vendors', $vendorcount);
            $admin->with('agents', $agentcount);
            $admin->with('domestictoday', $domestictodaycout);
            $admin->with('regionaltoday', $regionaltodaycout);
            $admin->with('domestic', $domesticcout);
            $admin->with('regional', $reginalcount);
           #domestic category
            $domesticpending=Oders::WHERE([['order_type','domestic'],['oder_status','pending']])->count();
            $domesticcreated=Oders::WHERE([['order_type','domestic'],['oder_status','created']])->count();
            $domesticcancelled=Oders::WHERE([['order_type','domestic'],['oder_status','cancelled']])->count();
            $domesticdelivering=Oders::WHERE([['order_type','domestic'],['oder_status','delivering']])->count();
            $domesticincomplete=Oders::WHERE([['order_type','domestic'],['oder_status','incomplete']])->count();
            $domesticcomplete=Oders::WHERE([['order_type','domestic'],['oder_status','complete']])->count();
            $admin->with('domesticpending', $domesticpending);
            $admin->with('domesticcreated', $domesticcreated);
            $admin->with('domesticancel', $domesticcancelled);
            $admin->with('domesticdeliver', $domesticdelivering);
            $admin->with('domesticinc', $domesticincomplete);
            $admin->with('domesticcomp', $domesticcomplete);
        });
    }
}
