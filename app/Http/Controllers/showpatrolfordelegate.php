<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class showpatrolfordelegate extends Controller
{
    public function __construct(){
        $this->middleware('delegate');
    }

    public function get($id){
        if(isset($id)){
            if(preg_match("/^[0-9 ]+$/", $id)){
                $get_daily_code = DB::table('daily')->where('iddaily',$id)->first();
                $last_table_infos = DB::table('patrol_summ')->where('iddaily',$get_daily_code->iddaily)->first();
                $get_gas_pomps = DB::table('patrol')->where('fuel_type','gasoline')->where('iddaily',$id)->where('date',$get_daily_code->timing)->get();
                $get_diesel_pomps = DB::table('patrol')->where('fuel_type','diesel')->where('iddaily',$id)->where('date',$get_daily_code->timing)->get();
                $get_es91_pomps = DB::table('patrol')->where('fuel_type','essence91')->where('iddaily',$id)->where('date',$get_daily_code->timing)->get();
                $get_es95_pomps = DB::table('patrol')->where('fuel_type','essence95')->where('iddaily',$id)->where('date',$get_daily_code->timing)->get();
                $fuel_prices = DB::table('fuel_price')->get();
                return view('patrol-show',['id'=>$id,'diesel_pomps'=>$get_diesel_pomps,'gas_pomps'=>$get_gas_pomps,'last_table'=>$last_table_infos,'fuelprices'=>$fuel_prices],['es91_pomps'=>$get_es91_pomps,'es95_pomps'=>$get_es95_pomps]);
            }
        }

    }
}
