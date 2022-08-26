<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Oders;
use Illuminate\Http\Request;

class VendorOrders extends Controller
{
    public function calculatecost(Request $request){
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
            return['status'=>true,'price'=>0];
         }
         else{
            $distance = substr($dist, 0, strpos($dist, "km"));
            if($request->transport=="carry"){
                $domcalculated = ceil(((2000*$distance)+(250*$time)+5000) / 500) * 500;
                return ['status' => true, 'price' => $domcalculated];
              }
              elseif($request->transport=="motocycle"){
                if($request->deliverytype=='standard'){
                    if($request->ordervalue > 0  && $request->ordervalue < 99999){
                        $domcalculated =ceil(((300*$distance)+(70*$time)+1300)*0.4 / 500) * 500;
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
                    return ['price' => 'Select transport type first'];
                 }
              }
              else{
                return ['status' => false];
              }
              return ['status' => true, 'price' => $domcalculated];
           
         }   
          
    }

    function store(Request $request){
              $orderdata= new Oders();
              $orderdata->oderid=random_int(1000,9999999);
              $orderdata->center=$request->center;
              $orderdata->customerid=$request->id;
              $orderdata->customernames=$request->name;
              $orderdata->order_type=$request->order;
              $orderdata->trans=$request->transport;
              $orderdata->from_location=$request->fromlocation;
              $orderdata->delv_location=$request->deliverylocation;
              $orderdata->delv_names=$request->receivernames;
              $orderdata->delv_phone=$request->receiverphone;
              $orderdata->py_type=$request->paymentype;
              $orderdata->value=$request->deliveryFee;
              $orderdata->item_value=$request->ordervalue;
              $orderdata->ord_details=$request->details;
              $orderdata->created_time=date('Y-m-d H:i:s');
              $orderdata->delivery_type=$request->deliverytype;
              $orderdata->oder_status='pending';
              $orderdata->save();
              return["status" => true] ;
          
    }
    public function getorder($id)
    {
        $response = Oders :: where('customerid',$id)->get();
        return $response;
    }
}
