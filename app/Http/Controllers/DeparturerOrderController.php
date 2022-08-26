<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\SmsController;
use App\Models\Oders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeparturerOrderController extends Controller
{
    public function neworder(){
        $neworder['dmneworders']=Oders::WHERE([
            ['order_type','domestic'],
            ['oder_status','created']
            ])->paginate();
          return view('departurer.domesticnew',$neworder);
    }
    public function deptview($orderid){
        $getdrivers['driverlists']=DB::table('users')->WHERE('role','driver')->SELECT('id','name','phone')->get();
        $getorder['order']=DB::table('oders')->WHERE('oderid',$orderid)->SELECT('oderid','ord_details',)->get();
        return view('departurer.domesticasign',$getdrivers,$getorder);
    }

    public function asignrider(Request $request,$orderid)
    {
        
        $request->validate(['rider'=> 'required']);
        $rider=DB::table('users')->WHERE('id',$request->rider)->SELECT('name','phone')->first();
        $tosend=" Habari $rider->name Una oda mpya";
        $user_contact = substr_replace($rider->phone, '255', 0, 1);
        $asignride=DB::table('oders')->WHERE('oderid',$orderid)
        ->update([
            'oder_status'=>'delivering',
            'riderid'=>$request->rider,
            'ridernames'=>$rider->name,
            'riderphone'=>$rider->phone,
        ]);
        if($asignride){
            //SmsController::sendsms($tosend,$user_contact);
            return redirect()->route('departurered')->with('succes','Order departured Successfully');
        }
        else {
            return redirect()->route('departurerview')->with('failed',' Sorry Order departurer Failed');
        }
        
    }

    public function deptorder(){
        $departuredorder['dptorders']=Oders::WHERE([
            ['order_type','domestic'],
            ['oder_status','delivering']
            ])->paginate();
          return view('departurer.domesticdpt',$departuredorder);
    }
}
