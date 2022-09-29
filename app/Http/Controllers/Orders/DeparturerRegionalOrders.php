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
    public function collectorder($id){
        $collect=Oders::WHERE('oderid',$id)->update(['oder_status'=>'collected']);
        if($collect){
            return redirect()->back()
            ->with('success','Order with Number:'.$id.'Successfully collected');
        }
        else{
            return redirect()->back()
            ->with('failed',' Sorry Order with Number:'.$id.'Not collected please try again');
        }  
    }
    public function collectedorder(){
        $neworder['regionalneworders']=Oders::WHERE([
            ['order_type','regional'],
            ['oder_status','collected']
            ])->join('centers','oders.center','=','centers.centerid')->get();
          return view('departurer.regionalcollected',$neworder);
    }
    public function departureorder($id){
        $collect=Oders::WHERE('oderid',$id)->update(['oder_status'=>'on the way']);
        if($collect){
            return redirect()->back()
            ->with('success','Order with Number:'.$id.'Successfully departured');
        }
        else{
            return redirect()->back()
            ->with('failed',' Sorry Order with Number:'.$id.'Not departured please try again');
        }  
    }

    public function alldorder(){
        $neworder['regionalneworders']=Oders::WHERE('order_type','regional')
        ->join('centers','oders.center','=','centers.centerid')->get();
          return view('departurer.regionalall',$neworder);
    }
}
