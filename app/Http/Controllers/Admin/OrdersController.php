<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Oders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function domestictoday(){
        $today=date('Y-m-d');
        $domestic['domesticorders']= Oders::WHERE([['order_type','domestic'],['created_date',$today]])->get();
        return view('admin.domestictoday',$domestic);
       }
    public function domesticpending(){
        $domestic['domesticorders']= Oders::WHERE([['order_type','domestic'],['oder_status','pending']])->get();
        return view('admin.domesticpending',$domestic);
       }
    public function domesticcreated(){
        $domestic['domesticorders']= Oders::WHERE([['order_type','domestic'],['oder_status','created']])->get();
        return view('admin.domesticcreated',$domestic);
       }
    public function domesticcancelled(){
        $domestic['domesticorders']= Oders::WHERE([['order_type','domestic'],['oder_status','cancelled']])->get();
        return view('admin.domesticcancel',$domestic);
       }
    public function domesticdeliver(){
        $domestic['domesticorders']= Oders::WHERE([['order_type','domestic'],['oder_status','delivering']])->get();
        return view('admin.domesticdeliver',$domestic);
       }
    public function domesticinc(){
        $domestic['domesticorders']= Oders::WHERE([['order_type','domestic'],['oder_status','incomplete']])->get();
        return view('admin.domesticincomplete',$domestic);
       }
    public function domesticcomp(){
        $domestic['domesticorders']= Oders::WHERE([['order_type','domestic'],['oder_status','complete']])->get();
        return view('admin.domesticcomplete',$domestic);
       } 
    public function domestic(){
        $domestic['domesticorders']= Oders::WHERE('order_type','domestic')->get();
        return view('admin.ordersdomestic',$domestic);
       }
       public function regional(){
        $regional['regionalorder']= Oders::WHERE('order_type','regional')->get();
        return view('admin.ordersregional',$regional);
       }
       public function international(){
        $international['internationaloders']= Oders::WHERE('order_type','international')->get();
        return view('admin.ordersinternational',$international);
       }
       public  function dashboardview(){
        $vaigousers = User::WHERE([['role','!=','admin']])
        ->select(DB::raw("role as role"),DB::raw("count(*) as numbers")) ->groupBy(DB::raw("role"))->get();
      $userresult[] = ['Role','Members'];
      foreach ($vaigousers as $key => $staffs) {
      $userresult[++$key] = [$staffs->role, (int)$staffs->numbers];
      }

      $deliveryfee = Oders::WHERE([['order_type','domestic']])
      ->select(DB::raw("oder_status as status"),DB::raw("SUM(value) as fee"))->groupBy(DB::raw("oder_status"))->get();
    $orderresult[] = ['Status','DeliveryFee'];
    foreach ($deliveryfee as $key => $orders) {
    $orderresult[++$key] = [$orders->status, (int)$orders->fee];
    }
     return view('admin.dashboard')->with(['users'=>json_encode($userresult),'oders'=>json_encode($orderresult)]);
       }
}
