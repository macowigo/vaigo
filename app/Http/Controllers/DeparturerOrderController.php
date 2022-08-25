<?php

namespace App\Http\Controllers;

use App\Models\Oders;
use Illuminate\Http\Request;

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
        return view('departurer.domesticasign');
    }
}
