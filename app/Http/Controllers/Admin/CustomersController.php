<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\SmsController;

class CustomersController extends Controller
{
    public function addcustomerform()
    {
        return view('admin.customeradd');
    }

    public function addcustomer(Request $request)
    {
        $request->validate([
            'phone'=>'required|unique:customers',
            'names'=>'required',
        ]);
        $user_contact = substr_replace($request->phone, '255', 0, 1);
        $savecustomerdata=Customers::insert([
        'id'=>random_int(1000000,9999999),
        'customernames'=>$request->names,
        'phone'=>$user_contact,
    ]);
    if($savecustomerdata){
        return redirect()->back()->with('success','Customer Successfully added');
    }
    else{
        return redirect()->back()->with('failed','Sorry customer Registration failed');
    }
    }
    public function customerslist()
    {
        $customerlist['customers']=Customers::all();
        return view('admin.customers',$customerlist);
    }

    public function customersmsform()
    {
        return view('admin.customersms');
    }
    public function customersendsms(Request $request)
    {
        $request->validate(['sms'=>'required|max:320']);
        $getcustomers=Customers::select('phone','customernames')->get();
        foreach($getcustomers as $customer){
         $sms="Habari $customer->customernames"."\n".
         $request->sms;
         SmsController::sendsms($sms,$customer->phone);
    }
    return redirect()->back()->with('success','SMS Successfully sent');
}

public function individualsmsform()
{
    return view('admin.customerindividualsms');
}
public function individualsendsms(Request $request)
{
    $request->validate(['sms'=>'required|max:320','phone'=>'required']);
    $sms=$request->sms;
    SmsController::sendsms($sms,substr_replace($request->phone, '255', 0, 1));
    return redirect()->back()->with('success','SMS Successfully sent');
}
}