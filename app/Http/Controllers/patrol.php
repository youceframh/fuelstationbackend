<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class patrol extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }
    public function get(){
        //check by annex id then by date
        $team_leader_email = Auth::user()->email;
        $team_leader_annex = DB::table('employees')->where('email',$team_leader_email)->first()->annex_id;
        $get_tanks_gasoline = DB::table('tanks')->where('annex_id',$team_leader_annex)->where('fuel type','gasoline')->get();
        $get_tanks_essence = DB::table('tanks')->where('annex_id',$team_leader_annex)->where('fuel type','essence')->get();
        foreach(json_decode($get_tanks_gasoline,true) as $t){
            $gas_pomps[] = DB::table('pomps')->where('tank_nbr',$t['tank number'])->get();
            }
        /*
        echo('<br>essence');
        foreach(json_decode($get_tanks_essence,true) as $t){
            $get_pomps = DB::table('pomps')->where('tank_nbr',$t['tank number'])->get();
            echo($get_pomps);
        }*/ 
        return view('patrol-add',['gas_pomps'=>$gas_pomps]);
       
    }
    public function post(Request $request){
        $team_leader_email = Auth::user()->email;
        $team_leader_annex = DB::table('employees')->where('email',$team_leader_email)->first()->annex_id;
        $get_tanks_gasoline = DB::table('tanks')->where('annex_id',$team_leader_annex)->where('fuel type','gasoline')->get();
        $get_tanks_essence = DB::table('tanks')->where('annex_id',$team_leader_annex)->where('fuel type','essence')->get();
        foreach(json_decode($get_tanks_gasoline,true) as $t){
            $gas_pomps[] = DB::table('pomps')->where('tank_nbr',$t['tank number'])->get();
            }
            
            foreach($gas_pomps as $pomp){
                foreach(json_decode($pomp,true) as $p){
                    $p_id = $p['id'];
                    echo($request->input($p_id));
                    //db insert
                }
            }
       
    }
}
