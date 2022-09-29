<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Oders;
use Illuminate\Http\Request;

class DeparturerRegionalOrders extends Controller
{
    public function neworder(){
        $neworder['regionalneworders']=Oders::WHERE([
            ['order_type','regional'],
            ['oder_status','created']
            ])->join('centers','oders.center','=','centers.centerid')->get();
          return view('departurer.regionalnew',$neworder);
    }
}
