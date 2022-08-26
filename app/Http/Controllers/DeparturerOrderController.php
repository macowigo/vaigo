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
    public function deptview(){
        $getdrivers['driverlists']=DB::table('users')->WHERE('role','driver')->SELECT('id','name','phone')->get();
        return view('departurer.domesticasign',$getdrivers);
    }

    public function asignrider(Request $request,$orderid)
    {
        $request->validate(['rider'=> 'required']);
        $rider=DB::table('users')->WHERE('id',$request->rider)->SELECT('name','phone')->first();
        $tosend="";
        $user_contact="";
        $asignride=DB::table('oders')->WHERE('oderid',$orderid)
        ->update([
            'oder_status'=>'departured',
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
            ['oder_status','departured']
            ])->paginate();
          return view('departurer.domesticdpt',$departuredorder);
    }
}
