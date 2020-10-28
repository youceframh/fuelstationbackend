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
        foreach(json_decode($get_tanks,true) as $tank){
            $get_pomps = DB::table('tanks_has_pomps')->where('tank_id',$tank['tank number'])->get();    

            foreach($get_pomps as $get_pomp){
                echo('hi');
                $get_tank_fuel_type =  DB::table('tanks')->where('tank number',$get_pomp->tank_id)->get();
                $tank_fueltype = json_decode($get_tank_fuel_type,true);
             }
             
             foreach($tank_fueltype as $tft){
                 if($get_tank_fuel_type && $tft['fuel type'] == 'gasoline'){
                     array_push($gas_pomps,$get_pomps);
                 }
                 if($get_tank_fuel_type && $tft['fuel type'] == 'essence'){
                     array_push($essense_pomps,$get_pomps);  
                 }
                } 
                
        }

       

        return view('patrol-add',['gas_pomps'=>$gas_pomps],['es_pomps'=>$essense_pomps]);
       
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
