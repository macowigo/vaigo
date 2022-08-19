<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Centers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CentersController extends Controller
{
    public function addcenterview(){
        return view('admin.centeradd');
    }
    public function savecenters( Request $request){
        $request->validate([
            'centername'=>'required',
            'centerlocation'=>'required'
        ]);
       $addcenter= DB::table('centers')->insert([
            'centerid'=>random_int(100,9999),
            'centername'=>$request->centername,
            'centerlocation'=>$request->centerlocation,
        ]);
        if($addcenter){
            return redirect()->route('centerlist')->with('success','center has been added successfully.');
        }
        else
        {
            return redirect()->route('addcenter')->with('success','errors occurs.');
        }
    }
    public function centerslist(){
        $centerlist['centerlist']=DB::table('centers')->select('*')->get();
        return view('admin.centers',$centerlist);
    }
    public function centersmanage(){
        $centerlist['centerlist']=DB::table('centers')->select('*')->get();
        return view('admin.centersmanage',$centerlist);
    }
    public function deletecenter( $centerid ){
        $delete=DB::table('centers')->WHERE('centerid',$centerid )->delete();
        if($delete){
            return redirect()->route('centemanage')->with('success','center has been added successfully.');
        }
        else{
            return redirect()->route('centemanage')->with('success','sorry action failed.');
        }

    }

    public function returncenter($centerid){
        $centerlist['centerlist']=DB::table('centers')->SELECT('*')->WHERE('centerid',$centerid)->get();
        return view('admin.centeredit',$centerlist);
    }
}
