<?php

namespace App\Http\Controllers\Agents;

use App\Http\Controllers\Controller;
use App\Models\Oders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
public function dashboardview()
{
    $usercenter=Auth::User()->centerid;
    $domesticorders = Oders::WHERE([['order_type','domestic'],['center',$usercenter]])
    ->select(DB::raw("oder_status as status"),DB::raw("SUM(value) as ordervalue"),
      DB::raw("SUM(item_value) as deliveryfee")) ->groupBy(DB::raw("oder_status"))->get();
  $result[] = ['Satus','DeliveryFee','OrderValue'];
  foreach ($domesticorders as $key => $value) {
  $result[++$key] = [$value->status, (int)$value->ordervalue, (int)$value->deliveryfee];
  }
    return view('agents.dashboard')->with('orders',json_encode($result));
}
public function createorderview()
{
    return view('agents.createorder');
}

}
