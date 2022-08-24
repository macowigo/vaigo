<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;

class SmsController extends Controller
{
    public static function sendsms($tosend,$user_contact){
        $username = 'VAIGO'; 
        $apiKey   = '4e8d99a1b1797f37e32241ca1f25f8e97fa0a1b6f961e1a3791dd5863fe18f8c';
        $AT       = new AfricasTalking($username, $apiKey);
        $sms      = $AT->sms();
        $result   = $sms->send([
            'to'   => $user_contact,
            'message' => $tosend,
            'from'=>'VAIGO' 
        ]);
      print_r($result);
    }
    
}
