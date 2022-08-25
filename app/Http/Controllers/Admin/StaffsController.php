<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\SmsController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffsController extends Controller
{
    public function addform()
    {
       $centerlist['centerlist']=DB::table('centers')->select('*')->get();
       return view('admin.staffadd',$centerlist);
    }

    public function addstaff(Request $request)
    {
    $password='Vaigo@'.random_int(100,999);
    $user_contact = substr_replace($request->phone, '255', 0, 1);
    $request->validate(['role'=>'required']);
    if($request->role=="center"){
        $tosend="Habari $request->names"."\n". "Your Vaigo account Successfully created."."\n".
        "Passwod: $password"."\n"."User name: $request->email";
        $request->validate([
            'phone'=>'required|unique:users',
            'email'=>'required|unique:users',
            'names'=>'required',
            'staffcenter'=>'required'
        ]);
    }
    elseif($request->role=="driver"){
        $tosend="Habari $request->names"."\n". "Your Vaigo account Successfully created."."\n".
        "Passwod: $password"."\n"."User name: $request->phone";
        $request->validate([
            'phone'=>'required|unique:users',
            'names'=>'required',
        ]);
    }
    else{
        $tosend="Habari $request->names"."\n". "Your Vaigo account Successfully created."."\n".
        "Passwod: $password"."\n"."User name: $request->email";
        $request->validate([
            'phone'=>'required|unique:users',
            'email'=>'required|unique:users',
            'names'=>'required',
        ]);
    }
  
    $insertstaffdata=DB::table('users')->insert([
        'id'=>random_int(1000000,9999999),
        'name'=>$request->names,
        'phone'=>$request->phone,
        'role'=>$request->role,
        'centerid'=>$request->staffcenter,
        'email'=>$request->email,
        'password'=>Hash::make($password),
    ]);
    if($insertstaffdata){
       SmsController::sendsms($tosend,$user_contact);
        return redirect()->route('staff')->with('succes','Staff Successfully registered');
    }
    else{
        return redirect()->route('staffform')->with('failed','Sorry Staff Registration failed');
    }
    }

    public function stafflist(){
        $staffs['stafflist']=DB::table('users')
        ->where([['role','!=','vendor'],['role','!=','admin']])
        ->select('*')
        ->get();
        return view('admin.staff',$staffs);
    }
    public function usersmanage(){
        $staffs['stafflist']=DB::table('users')
        ->where([['role','!=','vendor'],['role','!=','admin']])
        ->select('*')
        ->get();
        return view('admin.staffmanage',$staffs);
    }
    public function deleteuser($userid){
        $deleteuser=DB::table('users')->WHERE('id',$userid)->delete();
    if($deleteuser){
        return redirect()->route('manageusers')->with('succes','User deleted Successfully');
    }
    else{
        return redirect()->route('manageusers')->with('failed','sorry user deleted failed');
    }
    }
}
