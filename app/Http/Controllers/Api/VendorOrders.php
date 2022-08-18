<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
          $distance = substr($dist, 0, strpos($dist, "km"));
          if($request->tarnsport=="carry"){
            $domcalculated = ceil(((2000*$distance)+(250*$time)+5000) / 500) * 500;
          }
          elseif($request->tarnsport=="motocycle"){
            if($request->deliverytype=='standard'){
                if($request->ordervalue > 0  && $request->ordervalue < 99999){
                    $domcalculated = (0.4* ceil(((300*$distance)+(70*$time)+1300) / 500)) * 500;
                }
                elseif($request->ordervalue > 99999   && $request->ordervalue < 999999){
                    $domcalculated = (0.4 * ceil(((300*$distance)+(70*$time)+18000) / 500)) * 500;
                }
                else{
                    $domcalculated = (0.4 * ceil(((300*$distance)+(70*$time)+18000) / 500)) * 500;
                }
             }
             elseif($request->deliverytype=='express'){
                if($request->ordervalue > 0  && $request->ordervalue < 99999){
                    $domcalculated = ceil(((300*$distance)+(70*$time)+1300) / 500) * 500;
                }
                elseif($request->ordervalue > 99999   && $request->ordervalue < 999999){
                    $domcalculated = ceil(((300*$distance)+(70*$time)+18000) / 500) * 500;
                }
                else{
                    $domcalculated = ceil(((300*$distance)+(70*$time)+18000) / 500) * 500;
                }
             }
             else{
                return ['Select transport type first'];
             }
            
          }
          else{
            return ['sorry error occurs'];
            //return ['price' => $domcalculated];
          }
          return ['price' => $domcalculated];
    }
}
