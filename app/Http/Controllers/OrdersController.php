<?php

namespace App\Http\Controllers;

use App\Models\Oders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function index(){
        $data['orders'] = Oders::orderBy('oderid','desc')->paginate();
        return view('centers.index', $data);
   }
   public function domestic(){
    $usercenter=Auth::User()->centerid;
    $domesticdata['domesticorders']= Oders::WHERE([
      ['order_type','domestic'],
      ['center',$usercenter]
      ])->get();
      $domesticCount =count($domesticdata);
      with( $domesticCount);
    return view('centers.domesticorders',$domesticdata);
   }
   //domestic new
   public function domesticneworder(){
    $usercenter=Auth::User()->centerid;
    $domesticdata['domesticorders']= Oders::WHERE([
      ['order_type','domestic'],
      ['center',$usercenter],
      ['oder_status','ordered']
      ])->get();
    return view('centers.domesticnew',$domesticdata);
   }

   public function update( $id)
{
  $update = DB::table('oders')->where('oderid', $id)->update(['oder_status'=>'created']);
return redirect()->route('domesticnew')
->with('success','Company Has Been updated successfully');
}
   public function regional(){
    $usercenter=Auth::User()->centerid;
    $regionaldata['regionalorder']=Oders::WHERE([
      ['order_type','regional'],
      ['center',$usercenter]
      ])->paginate();
    return view('centers.regional',$regionaldata);
   }
 
   public function international(){
    $usercenter=Auth::User()->centerid;
    $international['internationaloders']= Oders::WHERE([
      ['order_type','international'],
      ['center',$usercenter]
      ])->paginate();
    return view('centers.international',$international);

   }

    public function create(){
        return view('centers.create');
    }
  //calculate cost
    public function calculatecost(Request $request){
      $request->validate([
        'fromlocation' => 'required',
        'deliverylocation' => 'required',
        'transport' => 'required',
        'ordervalue'=>'required',
        'deliverytype'=>'required'
        ]);
        $lat1=$request->fromLat;
        $long1=$request->fromLng;
        $lat2=$request->delvLat;
        $long2=$request->delvLng;
          $apiurl = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&key=AIzaSyCFnY0qEUXZW-efcSTWmQ2Ga7te_pNsA4o";
          $receiveddata = curl_init();
          curl_setopt($receiveddata, CURLOPT_URL, $apiurl);
          curl_setopt($receiveddata, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($receiveddata, CURLOPT_PROXYPORT, 3128);
          curl_setopt($receiveddata, CURLOPT_SSL_VERIFYHOST, 0);
          curl_setopt($receiveddata, CURLOPT_SSL_VERIFYPEER, 0);
          $response = curl_exec($receiveddata);
          curl_close($receiveddata);
          $response_a = json_decode($response, true);
          $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
          $time =round($response_a['rows'][0]['elements'][0]['duration']['value']/60,0) ;
          if(empty($dist) || empty($time)){
            return redirect('/orders/create')
          ->with('cost','Domestic cost For carry is: '.number_format(0) .' Tshs From:
              '.$request->fromlocation.' to: '.$request->deliverylocation );
          }
          else{
            $distance = substr($dist, 0, strpos($dist, "km"));
            if($request->transport=="carry"){
              $domcalculated = ceil(((2000*$distance)+(250*$time)+5000) / 500) * 500;
              return redirect('/orders/create')
            ->with('cost','Domestic cost For carry is: '.number_format($domcalculated) .' Tshs From:
                '.$request->fromlocation.' to: '.$request->deliverylocation );
            }
            elseif($request->transport=="motocycle"){
              if($request->deliverytype=='standard'){
                  if($request->ordervalue > 0  && $request->ordervalue < 99999){
                      $domcalculated = ceil(((300*$distance)+(70*$time)+1300) *0.4 / 500) * 500;
                  }
                  elseif($request->ordervalue > 99999   && $request->ordervalue < 999999){
                      $domcalculated = ceil(((300*$distance)+(70*$time)+1800) * 0.4 / 500) * 500;
                  }
                  else{
                      $domcalculated = ceil(((300*$distance)+(70*$time)+1800) * 0.4 / 500) * 500;
                  }
               }
               elseif($request->deliverytype=='express'){
                  if($request->ordervalue > 0  && $request->ordervalue < 99999){
                      $domcalculated = ceil(((300*$distance)+(70*$time)+1300) / 500) * 500;
                  }
                  elseif($request->ordervalue > 99999   && $request->ordervalue < 999999){
                      $domcalculated = ceil(((300*$distance)+(70*$time)+1800) / 500) * 500;
                  }
                  else{
                      $domcalculated = ceil(((300*$distance)+(70*$time)+1800) / 500) * 500;
                  }
               }
               else{
                return redirect('/orders/create')->with('cost','Sorry Select Transportation type first');
               }
            }
            else{
              return redirect('/orders/create')->with('cost','Sorry Error Occurs');
            }
            return redirect('/orders/create')
            ->with('cost','Domestic cost for Motocycle is: '.number_format($domcalculated) .' Tshs From:  '
            .$request->fromlocation.' to: '.$request->deliverylocation );

          }
    }

    //store data to database
    public function store(Request $request){
      if($request->ordertype=="domestic"){
        $request->validate([
          'ordertype' => 'required',
          'transport' => 'required',
          'fromlocation' => 'required',
          'deliverylocation' => 'required',
          'details' => 'required',
          'paymentype' => 'required',
          'receiverphone' => 'required',
          'ordervalue'=>'required',
          'deliverytype'=>'required',
          ]);
          $lat1=$request->fromLat;
          $long1=$request->fromLng;
          $lat2=$request->delvLat;
          $long2=$request->delvLng;
          $apiurl = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&key=AIzaSyCFnY0qEUXZW-efcSTWmQ2Ga7te_pNsA4o";
          $receiveddata = curl_init();
          curl_setopt($receiveddata, CURLOPT_URL, $apiurl);
          curl_setopt($receiveddata, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($receiveddata, CURLOPT_PROXYPORT, 3128);
          curl_setopt($receiveddata, CURLOPT_SSL_VERIFYHOST, 0);
          curl_setopt($receiveddata, CURLOPT_SSL_VERIFYPEER, 0);
          $response = curl_exec($receiveddata);
          curl_close($receiveddata);
          $response_a = json_decode($response, true);
          $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
          $time =round($response_a['rows'][0]['elements'][0]['duration']['value']/60,0) ;
          $distance = substr($dist, 0, strpos($dist, "km"));
          if($request->transport=="carry"){
            $domcalculated = ceil(((2000*$distance)+(250*$time)+5000) / 500) * 500;
          }
          elseif($request->transport=="motocycle"){
            if($request->deliverytype=='standard'){
                if($request->ordervalue > 0  && $request->ordervalue < 99999){
                    $domcalculated = ceil(((300*$distance)+(70*$time)+1300) * 0.4 / 500) * 500;
                }
                elseif($request->ordervalue > 99999   && $request->ordervalue < 999999){
                    $domcalculated = ceil(((300*$distance)+(70*$time)+1800) *0.4 / 500) * 500;
                }
                else{
                    $domcalculated = ceil(((300*$distance)+(70*$time)+1800) * 0.4 / 500) * 500;
                }
             }
             elseif($request->deliverytype=='express'){
                if($request->ordervalue > 0  && $request->ordervalue < 99999){
                    $domcalculated = ceil(((300*$distance)+(70*$time)+1300) / 500) * 500;
                }
                elseif($request->ordervalue > 99999   && $request->ordervalue < 999999){
                    $domcalculated = ceil(((300*$distance)+(70*$time)+1800) / 500) * 500;
                }
                else{
                    $domcalculated = ceil(((300*$distance)+(70*$time)+1800) / 500) * 500;
                }
             }

          }
          else{
            return redirect('/orders/create')->with('failed','Sorry Error Occurs');
          }
          // return array('distance' => $dist, 'time' => $time,'deliverytime'=>$deliverytime);

          $orderdata= new Oders;
          $orderdata->oderid=random_int(1000,9999999);
          $orderdata->center=Auth::User()->centerid;
          $orderdata->customer=$request->customer;
          $orderdata->order_type=$request->ordertype;
          $orderdata->trans=$request->transport;
          $orderdata->from_location=$request->fromlocation;
          $orderdata->from_latitude=$request->fromLat;
          $orderdata->from_longitude=$request->fromLng;
          $orderdata->delv_location=$request->deliverylocation;
          $orderdata->delv_latitude=$request->delvLat;
          $orderdata->delv_longitude=$request->delvLng;
          $orderdata->distance=$dist;
          $orderdata->delv_names=$request->receivernames;
          $orderdata->delv_phone=$request->receiverphone;
          $orderdata->py_type=$request->paymentype;
          $orderdata->value=$domcalculated;
          $orderdata->item_value=$request->ordervalue;
          $orderdata->ord_details=$request->details;
          $orderdata->created_time=date('Y-m-d H:i:s');
          $orderdata->delivery_type=$request->deliverytype;
          $orderdata->oder_status='created';
         $orderdata->save();
         return redirect()->route('domesticorder')
  ->with('success','Order has been created successfully.');
      }
      //end domestic order
      else{
        $request->validate([
          'ordertype' => 'required',
          'pickup' => 'required',
          'dellocation' => 'required',
          'percelsize' => 'required',
          'value' => 'required',
          'details' => 'required',
          'paymentype' => 'required',
          'receivernames' => 'required',
          'receiverphone' => 'required'
          ]);
     
      $orderdata= new Oders;
      $orderdata->oderid=random_int(1000,9999999);
      $orderdata->center=Auth::User()->centerid;
      $orderdata->customer=$request->customer;
      $orderdata->order_type=$request->ordertype;
      $orderdata->pick_up=$request->pickup;
      $orderdata->desination=$request->dellocation;
      $orderdata->parcel_size=$request->percelsize;
      $orderdata->value=$request->value;
      $orderdata->ord_details=$request->details;
      $orderdata->py_type=$request->paymentype;
      $orderdata->delv_names=$request->receivernames;
      $orderdata->delv_phone=$request->receiverphone;
      $orderdata->oder_status='created';
     $orderdata->save();
     return redirect()->route('regionalorder')
->with('success','Order has been created successfully.');
      }


    }
//delete order
    public function destroy($orderid){
    $deleted = DB::table('oders')->WHERE('oderid',$orderid)->delete();
     return redirect()->route('orders.index')->with('success','Order Succesfully Deleted');
}

}
