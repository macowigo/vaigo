<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\SmsController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VendorsController extends Controller
{
    public function addvendorform(){
    $centerlist['centerlist']=DB::table('centers')->select('*')->get();
    return view('admin.vendoradd',$centerlist);
        
    }
  
   public function registervendor(Request $request){
    $password='Vaigo@'.random_int(100,999);
    $tosend="Habari $request->vendornames"."\n". "Your Vaigo account Successfully created."."\n".
    "Passwod: $password"."\n"."User name: $request->phone";
    $user_contact = substr_replace($request->phone, '255', 0, 1);
    $request->validate([
        'vendornames'=>'required',
        'phone'=>'required|unique:users',
        'vendorlocation'=>'required',
        'vendorcenter'=>'required'
    ]);
    $insertvendordata=DB::table('users')->insert([
        'id'=>random_int(1000000,9999999),
        'name'=>$request->vendornames,
        'phone'=>$request->phone,
        'role'=>'vendor',
        'centerid'=>$request->vendorcenter,
        'vendor_location'=>$request->vendorlocation,
        'vendor_lat'=>$request->vendorLat,
        'vendor_long'=>$request->vendorLng,
        'password'=>Hash::make($password),
    ]);
    if($insertvendordata){
        // SmsController::sendsms($tosend,$user_contact);
        return redirect()->route('vendors')->with('succes','Vendor Succesfully registered');
    }
    else{
        return redirect()->route('vendorform')->with('failed','Sorry Vendor Registration failed');
    }  
}
public function vendorslist(){
    $vendors['vendorlist']=DB::table('users')
    ->join('centers','users.centerid','=','centers.centerid')
    ->where('role','vendor')->select('*')->get();
    return view('admin.vendor',$vendors);
}

public function vendorsmanage(){
    $vendors['vendorlist']=DB::table('users')
    ->join('centers','users.centerid','=','centers.centerid')
    ->where('role','vendor')->select('*')->get();
    return view('admin.vendormanage',$vendors);
}
public function deletevendor($userid)
{
    $deletevendor=DB::table('users')->WHERE('id',$userid)->delete();
    if($deletevendor){
        return redirect()->route('vendorsmanage')->with('success','vendor deleted succesfully');
    }
    else{
        return redirect()->route('vendorsmanage')->with('failed','sorry vendor deleted failed');
    }
}
public function getvendor($vendorid)
{
    $centerlist['centerlist']=DB::table('centers')->select('*')->get();
    $vendors['vendorlist']=DB::table('users')->where('id',$vendorid)->select('*')->get();
    return view('admin.vendoredit',$vendors,$centerlist);
}
public function updatevendor(Request $request,$vendorid)
{
    $request->validate([
        'vendornames'=>'required',
        'vendorlocation'=>'required',
        'vendorcenter'=>'required'
    ]);
    $updatevendor=DB::table('users')->WHERE('id',$vendorid)
    ->update([
        'name'=>$request->vendornames,
        'phone'=>$request->phone,
        'centerid'=>$request->vendorcenter,
        'vendor_location'=>$request->vendorlocation,
        'vendor_lat'=>$request->vendorLat,
        'vendor_long'=>$request->vendorLng,
    ]);
    if($updatevendor){
        return redirect()->route('vendorsmanage')->with('success','vendor updated succesfully');
    }
    else{
        return redirect()->route('editvendorview')->with('failed',' sorry vendor updated failed');
    }
    
}
}
