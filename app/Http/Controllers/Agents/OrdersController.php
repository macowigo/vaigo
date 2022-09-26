<?php

namespace App\Http\Controllers\Agents;

use App\Http\Controllers\Api\SmsController;
use App\Http\Controllers\Controller;
use App\Models\Centers;
use App\Models\Oders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
public function dashboardview()
{
    $usercenter=Auth::User()->centerid;
    $domesticorders = Oders::WHERE([['order_type','regional'],['center',$usercenter]])
    ->select(DB::raw("oder_status as status"),DB::raw("SUM(value) as ordervalue"),
      DB::raw("SUM(item_value) as deliveryfee")) ->groupBy(DB::raw("oder_status"))->get();
  $result[] = ['Satus','DeliveryFee','OrderValue'];
  foreach ($domesticorders as $key => $value) {
  $result[++$key] = [$value->status, (int)$value->ordervalue, (int)$value->deliveryfee];
  }
    return view('agents.dashboard')->with('orders',json_encode($result));
}
#create domestic order
public function createorderview()
{
    $agentcenters['centers']=Centers::WHERE('type','agentlocation')
    ->distinct('centername')->orderBy('centername')->get();
    return view('agents.createorder',$agentcenters);
}
public function calculatefee(Request $request){
    $request->validate([
        'desinationregion'=>'required',
        'percelsize'=>'required',
        'ordervalue'=>'required',
    ]);
    $getcenterlocation=Centers::WHERE('centerid',$request->desinationregion)->first();
    $getmycenter=Centers::WHERE('centerid',Auth::user()->centerid)->first();
    if($getmycenter->centername==$getcenterlocation->centername){
        return redirect()->back()->with('failed','Sorry From Region and Desination Region can not be the same please try again');
    }
    if($request->ordervalue > 99999){
      $deliveryfee=$request->ordervalue /10;
    }
    else{
        if($request->percelsize=='Small'){
            if($getmycenter->centername=='MOROGORO' || $request->desinationregion=='MOROGORO'){
                $deliveryfee=5000;
            }
            else{
                $deliveryfee=10000;
            }
        }
        else{
            if($getmycenter->centername=='MOROGORO' || $request->desinationregion=='MOROGORO'){
                $deliveryfee=10000;
               }
            else{
                $deliveryfee=20000;
            }
        }
    }
    return redirect()->back()
    ->with('cost','Cost From '.$getmycenter->centername.' To '.$getcenterlocation->centername.
    ' For '.$request->percelsize.' Percel of Value '.number_format($request->ordervalue).
    ' is '.number_format($deliveryfee));
}

public function createregionalorder(Request $request)
{
    $request->validate([
        'desinationregion'=>'required',
        'percelsize'=>'required',
        'ordervalue'=>'required',
        'orderdetails'=>'required',
        'sendernames'=>'required',
        'senderphone'=>'required',
        'receivernames'=>'required',
        'receiverphone'=>'required'
    ]);
    $getcenterlocation=Centers::WHERE('centerid',$request->desinationregion)->first();
    $getmycenter=Centers::WHERE('centerid',Auth::user()->centerid)->first();
    if($getmycenter->centername==$getcenterlocation->centername){
        return redirect()->back()->with('failed','Sorry From Region and Desination Region can not be the same please try again');
    }
    else{
       #calculate fee
       if($request->ordervalue > 99999){
        $deliveryfee=$request->ordervalue/10;
      }
      else{
          if($request->percelsize=='Small'){
              if($getmycenter->centername=='MOROGORO' || $getcenterlocation->centername=='MOROGORO'){
                  $deliveryfee=5000;
              }
              else{
                  $deliveryfee=10000;
              }
          }
          else{
              if($getmycenter->centername=='MOROGORO' || $getcenterlocation->centername=='MOROGORO'){
                  $deliveryfee=10000;
              }
              else{
                  $deliveryfee=20000;
              }
          }
      }
        $orderid=random_int(1000,9999999);
        $saveorder=Oders::insert([
            'oderid'=>$orderid,
            'center'=>Auth::User()->centerid,
            'order_type'=>'regional',
            'oder_status'=>'created',
            'from_location'=>$getmycenter->centername,
            'delv_location'=>$getcenterlocation->centername,
            'pick_up'=>$getcenterlocation->centerlocation,
            'item_value'=>$request->ordervalue,
            'ord_details'=>$request->orderdetails,
            'value'=>$deliveryfee,
            'customernames'=>$request->sendernames,
            'customerphone'=>$request->senderphone,
            'delv_names'=>$request->receivernames,
            'delv_phone'=>$request->receiverphone,
            'desination'=>$request->desinationregion,
            'parcel_size'=>$request->percelsize
           
        ]);
        if($saveorder){
            $date=date('d F Y, H:i:s');
            $sms="Percel Tiket Details"."\n"."From: $getmycenter->centername"."\n".
            "To: $getcenterlocation->centername ($getcenterlocation->centerlocation)"."\n". 
            "Percel Number: $orderid "."\n"."Percel Value: $request->ordervalue"."\n".
            "Type: $request->percelsize,$request->orderdetails "."\n".
            "Issued Date: $date"."\n"."Thank you for Choosing Vaigo"."\n". "TEL: 0715881342";
            //SmsController::sendsms($sms,substr_replace($request->senderphone, '255', 0, 1));
            return redirect()->route('agenttodayorders')->with('success','Your Order Successfully Created');
        }
        else{
            return redirect()->back()->with('failed','Sorry Order creation failed please try again');
        }
    }
    
}
    public function todayregionalorders()
    {
        $usercenter=Auth::user()->centerid;
        $ordertoday['orders']=Oders::WHERE([['order_type','regional'],['center',$usercenter]])
            ->whereDate('created_at',DB::raw('CURDATE()'))->get();
       return view('agents.ordersregionaltoday',$ordertoday);
    }

    public function monthlyregionalorders()
    {
        $usercenter=Auth::user()->centerid;
        $ordertoday['orders']=Oders::WHERE([['order_type','regional'],['center',$usercenter]])
            ->whereMonth('created_at',date('m'))->get();
       return view('agents.ordersregionalmonthly',$ordertoday);
    }
    
    public function commisontoday(){
        $commisiontoday['orders']=Oders::WHERE([['order_type','regional']])
        ->WHERE(function($commision){
        $commision->where('center',Auth::user()->centerid)->orWhere('desination',Auth::user()->centerid);
        })->whereDate('created_at',DB::raw('CURDATE()'))->get();
        return view('agents.commissiontoday',$commisiontoday);
    }

    public function commisonmonthly(){
        $commisionmonthly['orders']=Oders::WHERE([['order_type','regional']])
        ->WHERE(function($commision){
        $commision->where('center',Auth::user()->centerid)->orWhere('desination',Auth::user()->centerid);
        })->whereMonth('created_at',date('m'))->get();
        return view('agents.commissionmonthly',$commisionmonthly);
    }

    public function manageregionalorders()
    {
        $usercenter=Auth::user()->centerid;
        $managedorders['orders']=Oders::WHERE([['order_type','regional'],['center',$usercenter]])
            ->whereMonth('created_at',date('m'))->get();
       return view('agents.ordersregionmanage',$managedorders);
    }
    public function resendsms($id)
    {
        $orderdetails=Oders::WHERE('oderid',$id)->first();
        $date=date('d F Y, H:i:s',strtotime($orderdetails->created_at));
        $sms="Percel Tiket Details"."\n"."From: $orderdetails->from_location"."\n".
        "To: $orderdetails->delv_location ($orderdetails->pick_up)"."\n". "Percel Number: $id "."\n".
        "Percel Value: $orderdetails->item_value"."\n"."Type: $orderdetails->parcel_size,$orderdetails->ord_details "."\n".
        "Issued Date: $date"."\n"."Thank you for Choosing Vaigo"."\n"."TEL: 0715881342";
        SmsController::sendsms($sms,substr_replace($orderdetails->customerphone, '255', 0, 1));
       return redirect()->back()->with('success','Sms for Percel#: ' .$id.' Resent Successfully');
    }
    public function cancelorder($id)
    {
        $cancelorder=Oders::WHERE('oderid',$id)->update(['oder_status'=>'cancelled']);
        if($cancelorder){
            $orderdetails=Oders::WHERE('oderid',$id)->first();
            $sms="Sorry dear customer your order of Number:$id From: $orderdetails->from_location To: $orderdetails->delv_location has cancelled"."\n". 
            "Thank you for Choosing Vaigo"."\n"."TEL: 0715881342";
            $user_contact=substr_replace($orderdetails->customerphone, '255', 0, 1).','.substr_replace($orderdetails->delv_phone, '255', 0, 1);
            //SmsController::sendsms($sms,$user_contact);
           return redirect()->back()->with('success','Order of Percel#: ' .$id.' has Cancelled Successfully');
        }
        else{
            return redirect()->back()->with('fail','Sorry Order of Percel#: ' .$id.' not Cancelled please try again');
        } 
    }


}
