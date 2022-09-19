<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgentsController extends Controller
{
    public function agentlocationform()
    {
        return view('admin.agentlocationadd');
    }
    public function addagentlocation(Request $request)
    {
        $request->validate([
            'centername'=>'required',
            'centerlocation'=>'required'
        ]);
       $addcenter= DB::table('centers')->insert([
            'centerid'=>random_int(100,9999),
            'centername'=>$request->centername,
            'centerlocation'=>$request->centerlocation,
            'type'=>'agentlocation'
        ]);
        if($addcenter){
            return redirect()->route('agentlocation')->with('success','agent center has been added successfully.');
        }
        else
        {
            return redirect()->back()->with('failed','errors occurs.');
        }
    }
    public function agentlocationlist(){
        $centerlist['centerlist']=DB::table('centers')->where('type','agentlocation')->get();
        return view('admin.agentlocations',$centerlist);
    }
    public function centersmanage(){
        $centerlist['centerlist']=DB::table('centers')->where('type','agentlocation')->get();
        return view('admin.agentcentersmanage',$centerlist);
    }
}
