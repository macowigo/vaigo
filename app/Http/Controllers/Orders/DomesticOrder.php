<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Oders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DomesticOrder extends Controller
{
  #calculate cost
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
      if(empty($request->fromLat)||empty($request->fromLng)||empty($request->delvLat)||empty($request->delvLng)){
        return redirect('/orders/create')->with('wronglocations','Sorry wrong locations selected');
      }
        else{
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
            ->with('cost','Domestic cost For carry is: 0 Tshs From:
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
   }
      #add order
      public function createorder(Request $request){
          $request->validate([
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
            if(empty($request->fromLat)||empty($request->fromLng)||empty($request->delvLat)||empty($request->delvLng)) {
              return redirect('/orders/create')->with('failed','Sorry wrong locations selected'); 
              }
           else{
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
                  $domcalculated=0;
                }
                else{
                  $distance = substr($dist, 0, strpos($dist, "km"));
                  if($request->transport=="carry"){
                    $domcalculated = ceil(((2000*$distance)+(250*$time)+5000) / 500) * 500;
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
                      return redirect('/orders/create')->with('failed','Sorry Select Transportation type first');
                      }
                  }
                  else{
                    return redirect('/orders/create')->with('failed','Sorry Error Occurs');
                  }
                }
                $orderdata= new Oders;
                $orderdata->oderid=random_int(1000,9999999);
                $orderdata->center=Auth::User()->centerid;
                $orderdata->customernames=$request->customer;
                $orderdata->order_type='domestic';
                $orderdata->trans=$request->transport;
                $orderdata->from_location=$request->fromlocation;
                $orderdata->from_latitude=$request->fromLat;
                $orderdata->from_longitude=$request->fromLng;
                $orderdata->delv_location=$request->deliverylocation;
                $orderdata->delv_latitude=$request->delvLat;
                $orderdata->delv_longitude=$request->delvLng;
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
               return redirect()->route('domesticorder')->with('success','Order has been created successfully.');   
          }
      }

    public function domesticneworder(){
        $usercenter=Auth::User()->centerid;
        $domesticdata['domesticorders']= Oders::WHERE([
          ['order_type','domestic'],
          ['center',$usercenter],
          ['oder_status','pending']
          ])->get();
        return view('centers.domesticnew',$domesticdata);
       }
       
       public function domestictoday(){
        $today=date('Y-m-d');
        $usercenter=Auth::User()->centerid;
        $domesticdata['domestictodayorders']= Oders::WHERE([
          ['order_type','domestic'],
          ['center',$usercenter],
          ['created_date',$today]
          ])->get();
        return view('centers.domestictoday',$domesticdata);
       }

       public function acceptorder( $id){
        $createorder = DB::table('oders')->where('oderid', $id)->update(['oder_status'=>'created']);
        if($createorder){
          return redirect()->route('domesticnew')->with('success','Order ceated successfully');
        }
        else{
          return redirect()->route('domesticnew')->with('failed',' Sorry Order ceation failed');
        }
          }

    public function cancelorder($id){ 
        $cancelorder=DB::table('oders')->WHERE('oderid',$id)->update(['oder_status'=>'cancelled']);
        if($cancelorder){
            return redirect()->route('domesticnew')->with('success','Order cancelled successfully');
        }
        else{
            return redirect()->route('domesticnew')->with('failed','Sorry Order cancellation failed');
        }
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
       
    public  function dashboardview(){
        $usercenter=Auth::User()->centerid;
        $domesticorders = Oders::WHERE([['order_type','domestic'],['center',$usercenter]])
        ->select(DB::raw("oder_status as status"),DB::raw("SUM(value) as ordervalue"),
          DB::raw("SUM(item_value) as deliveryfee")) ->groupBy(DB::raw("oder_status"))->get();
      $result[] = ['Satus','DeliveryFee','OrderValue'];
      foreach ($domesticorders as $key => $value) {
      $result[++$key] = [$value->status, (int)$value->ordervalue, (int)$value->deliveryfee];
      }
     return view('centers.dashboard')->with('orders',json_encode($result));
       }
}
