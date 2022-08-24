<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Oders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
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
}
