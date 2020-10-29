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
        $gas_pomps = [];
        $essense_pomps = [];
        $searchQGasoline = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$team_leader_annex AND `fuel_type`='gasoline' ");
         $searchQEssence = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$team_leader_annex AND `fuel_type`='essence'");


        return view('patrol-add',['gas_pomps'=>$searchQGasoline],['es_pomps'=>$searchQEssence]);

    }
    public function post(Request $request){
        $team_leader_email = Auth::user()->email;
        $team_leader_annex = DB::table('employees')->where('email',$team_leader_email)->first()->annex_id;
        $searchQGasoline = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$team_leader_annex AND `fuel_type`='gasoline' ");
        $searchQEssence = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$team_leader_annex AND `fuel_type`='essence'");

        $date =  date('Y-m-d');
        function randomPassword() {
            $alphabet = 'abc_-defghijklmnopqrstuv/.wxyzABCDEF$$GHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i <= 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass); //turn the array into a string
        }

        $daily = DB::table('daily')->insertGetId(array(
            'iddaily' => null,
            'timing' => $date,
            'code' => randomPassword(),  
        ));

            foreach($searchQGasoline as $pomp){ //gasoline insert
            $pomp_serial = $pomp->pomp_serial;
                 $pomp_s = $request->input('g'.$pomp_serial);
                 $pomp_newrecord = $request->input('g'.$pomp_serial);
                 $diffence = DB::table('pomps')->where('serial',$pomp_serial)->first()->last_record;
                  //insertGetId
                $patrol = DB::table('patrol')->insert(array(
                    'date' =>$date,
                    'pomp_serial'=>$pomp_serial,
                    'new_record'=>$pomp_newrecord,
                    'diffrenece_in_l'=>($pomp_newrecord-$diffence),
                    'annex_id'=>$team_leader_annex,
                    'name_of_saver'=>Auth::user()->name,
                    'fuel_type'=>'gasoline',
                    'iddaily'=>$daily,
                ));

                $thp = DB::table('tanks_has_pomps')->where('pomp_serial',$pomp_serial)->where('tank_fuel_type','gasoline')->update([
                    'last_record' => $pomp_newrecord
                ]);
            }
       

    foreach($searchQEssence as $pomp){ //essence insert
        $pomp_serial = $pomp->pomp_serial;
             $pomp_s = $request->input('e'.$pomp_serial);
             $pomp_newrecord = $request->input('e'.$pomp_serial);
             $diffence = DB::table('pomps')->where('serial',$pomp_serial)->first()->last_record;
              //insertGetId
            $patrol = DB::table('patrol')->insert(array(
                'date' =>$date,
                'pomp_serial'=>$pomp_serial,
                'new_record'=>$pomp_newrecord,
                'diffrenece_in_l'=>($pomp_newrecord-$diffence),
                'annex_id'=>$team_leader_annex,
                'name_of_saver'=>Auth::user()->name,
                'fuel_type'=>'essence',
                'iddaily'=>$daily,
            ));

            $thp = DB::table('tanks_has_pomps')->where('pomp_serial',$pomp_serial)->where('tank_fuel_type','essence')->update([
                'last_record' => $pomp_newrecord
            ]);
        }

        return view('patrol-add',['gas_pomps'=>$searchQGasoline],['es_pomps'=>$searchQEssence]);
   
}

}
