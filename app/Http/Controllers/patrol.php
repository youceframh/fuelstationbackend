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
        $get_tanks = DB::table('tanks')->where('annex_id',$team_leader_annex)->get();
        //$poms = DB::table('poms')->where('annex_id',$team_leader_annex)->get();
        $gas_pomps = [];
        $essense_pomps = [];
        //SELECT * FROM tanks t LEFT JOIN tanks_has_pomps thp  
        $searchQGasoline = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$team_leader_annex AND `fuel_type`='gasoline' ");
         $searchQEssence = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$team_leader_annex AND `fuel_type`='essence'");


        return view('patrol-add',['gas_pomps'=>$searchQGasoline],['es_pomps'=>$searchQEssence]);
       //SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank number` WHERE annex_id=6

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
