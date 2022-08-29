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
    public function incompleteorders(){
        $domesticincomplete['incompleteorders']=Oders::WHERE([
            ['order_type','domestic'],
            ['oder_status','incomplete']
            ])->paginate();
          return view('departurer.domesticinc',$domesticincomplete);
    }
    public function completeorders(){
        $domesticcomplete['completeorders']=Oders::WHERE([
            ['order_type','domestic'],
            ['oder_status','complete']
            ])->paginate();
          return view('departurer.domesticcomp',$domesticcomplete);
    }
    public function domesticallorders(){
        $domesticall['domesticallorders']=Oders::WHERE([['order_type','domestic']])->paginate();
          return view('departurer.domesticall',$domesticall);
    }
    public function managedeptorder(){
        $departuredorder['dptorders']=Oders::WHERE([
            ['order_type','domestic'],
            ['oder_status','delivering']
            ])->paginate();
          return view('departurer.domesticmanage',$departuredorder);
    }
    public function cancelorder($id){
        $incomplete=DB::table('oders')->WHERE('oderid',$id)->update(['oder_status'=>'incomplete']);
        if($incomplete){
            return redirect()->route('dptmanage')->with('succes','OrderSuccessfully cancelled');
        }
        else
        {
         return redirect()->route('dptmanage')->with('succes','Sorry Order Cancellation failed');
        }
          
    }
}
