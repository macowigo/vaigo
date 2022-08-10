<?php

namespace App\Http\Controllers;

use App\Models\Oders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store(Request $request){
        $request->validate([
            'ordertype' => 'required',
            'transport' => '',
            'delvlocation' => '',
            'delvltime' => '',
            'pickup' => '',
            'dellocation' => '',
            'percelsize' => '',
            'details' => 'required',
            'value' => '',
            'paymentype' => 'required',
            'receivernames' => 'required',
            'receiverphone' => 'required'
            ]);
            //calculate distance
            if($request->ordertype=="domestic"){
                // $earthRadius = 6371;
                // $latFrom = deg2rad($request->fromLat);
                // $lonFrom = deg2rad($request->fromLng);
                // $latTo = deg2rad($request->delvLat);
                // $lonTo = deg2rad($request->delvLng);
                // $latDelta=deg2rad($request->delvLat)-deg2rad($request->fromLat);
                // $lonDelta=deg2rad($request->delvLng)-deg2rad($request->fromLng);
                // $latDelta = $latTo - $latFrom;
                // $lonDelta = $lonTo - $lonFrom;
                // $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                //   cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
                // $distance= number_format((float)$angle * $earthRadius,1,'.', '') ;
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
    $time = $response_a['rows'][0]['elements'][0]['duration']['text'];
    if(str_contains($time,'hours')){
      return redirect()->route('orders.create')
      ->with('failed','Sorry there is error occurs in calculating cost.');
    }
    else{
    $distance = substr($dist, 0, strpos($dist, "km"));
    $minutes = substr($time, 0, strpos($time, "mins"));
    $domesticcost = ceil(((25*$distance)+(60*$minutes)+700) / 100) * 100;
    $deliverytime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." + $minutes minutes"));
     }
   // return array('distance' => $dist, 'time' => $time,'cost'=>$domesticcost,'deliverytime'=>$deliverytime);
            }
        $orderdata= new Oders;
        $orderdata->oderid=random_int(1000,9999999);
        $orderdata->center=Auth::User()->centerid;
        $orderdata->customer=$request->customer;
        $orderdata->order_type=$request->ordertype;
        $orderdata->trans=$request->transport;
        $orderdata->from_location=$request->fromlocation;
        $orderdata->from_latitude=$request->fromLat;
        $orderdata->from_longitude=$request->fromLng;
        $orderdata->delv_location=$request->delvlocation;
        $orderdata->delv_latitude=$request->delvLat;
        $orderdata->delv_longitude=$request->delvLng;
        $orderdata->distance=$dist;
        $orderdata->delv_names=$request->receivernames;
        $orderdata->delv_phone=$request->receiverphone;
        $orderdata->py_type=$request->paymentype;
        $orderdata->value=$domesticcost;
        $orderdata->ord_details=$request->details;
        $orderdata->pick_up=$request->pickup;
        $orderdata->desination=$request->dellocation;
        $orderdata->parcel_size=$request->percelsize;
        $orderdata->delivery_time=$deliverytime;
        $orderdata->oder_status='created';
       $orderdata->save();
       return redirect()->route('domesticorder')
->with('success','Order has been created successfully.');

    }

}
