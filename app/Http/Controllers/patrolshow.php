<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class patrolshow extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }
    public function get(){
        //date("Y-m-d", time() - 60 * 60 * 24);
        $team_leader_email = Auth::user()->email;
        $team_leader_annex = DB::table('employees')->where('email',$team_leader_email)->first()->annex_id;

      if(DB::table('patrol')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d"))->get() != "[]"){

        $last_table_infos_getting_iddaily = $get_gas_pomps = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d"))->first()->iddaily;
        $last_table_infos = DB::table('patrol_summ')->where('iddaily',$last_table_infos_getting_iddaily)->first();
        $get_gas_pomps = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d"))->get();
        $get_diesel_pomps = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d"))->get();
        $get_es91_pomps = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d"))->get();
        $get_es95_pomps = DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d"))->get();
        $last_table_infos;

        return view('patrol-show',['diesel_pomps'=>$get_diesel_pomps,'gas_pomps'=>$get_gas_pomps,'last_table'=>$last_table_infos],['es91_pomps'=>$get_es91_pomps,'es95_pomps'=>$get_es95_pomps]);
      
    }elseif(DB::table('patrol')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d", time() - 60 * 60 * 24))->get() != "[]"){
        $last_table_infos_getting_iddaily = $get_gas_pomps = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d", time() - 60 * 60 * 24))->first()->iddaily;
        $last_table_infos = DB::table('patrol_summ')->where('iddaily',$last_table_infos_getting_iddaily)->first();

        $get_gas_pomps = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d", time() - 60 * 60 * 24))->get();
        $get_diesel_pomps = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d", time() - 60 * 60 * 24))->get();
        $get_es91_pomps = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d", time() - 60 * 60 * 24))->get();
        $get_es95_pomps = DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d", time() - 60 * 60 * 24))->get();

        return view('patrol-show',['diesel_pomps'=>$get_diesel_pomps,'gas_pomps'=>$get_gas_pomps,'last_table'=>$last_table_infos],['es91_pomps'=>$get_es91_pomps,'es95_pomps'=>$get_es95_pomps]);

      }else{
/*Patrol-add */
        $team_leader_email = Auth::user()->email;
        $team_leader_annex = DB::table('employees')->where('email',$team_leader_email)->first()->annex_id;
        $get_tanks = DB::table('tanks')->where('annex_id',$team_leader_annex)->get();

        $searchQGasoline = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$team_leader_annex AND `fuel_type`='gasoline' ");
        $searchQDiesel = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$team_leader_annex AND `fuel_type`='diesel' ");

         $searchQEssence91 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$team_leader_annex AND `fuel_type`='essence91'");
         $searchQEssence95 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$team_leader_annex AND `fuel_type`='essence95'");

        return view('patrol-add',['diesel_pomps'=>$searchQDiesel,'gas_pomps'=>$searchQGasoline],['es91_pomps'=>$searchQEssence91,'es95_pomps'=>$searchQEssence95]);
    
      }
      
        
    }
    public function post(Request $request){
        $team_leader_email = Auth::user()->email;
        $team_leader_annex = DB::table('employees')->where('email',$team_leader_email)->first()->annex_id;
        $searchQGasoline = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$team_leader_annex AND `fuel_type`='gasoline' ");
        $searchQDiesel = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$team_leader_annex AND `fuel_type`='diesel' ");
        $searchQEssence91 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$team_leader_annex AND `fuel_type`='essence91'");
        $searchQEssence95 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$team_leader_annex AND `fuel_type`='essence95'");


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
                 $fuel_price = DB::table('fuel_price')->where('fuel_type','gasoline')->first()->price;
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
                    'price_of_fuel' => $fuel_price,
                ));

                $thp = DB::table('tanks_has_pomps')->where('pomp_serial',$pomp_serial)->where('tank_fuel_type','gasoline')->update([
                    'last_record' => $pomp_newrecord
                ]);

               
            }
       

    foreach($searchQDiesel as $pomp){ //diesel insert
        $pomp_serial = $pomp->pomp_serial;
             $pomp_s = $request->input('d'.$pomp_serial);
             $pomp_newrecord = $request->input('d'.$pomp_serial);
             $diffence = DB::table('pomps')->where('serial',$pomp_serial)->first()->last_record;
             $fuel_price = DB::table('fuel_price')->where('fuel_type','diesel')->first()->price;
              //insertGetId
            $patrol = DB::table('patrol')->insert(array(
                'date' =>$date,
                'pomp_serial'=>$pomp_serial,
                'new_record'=>$pomp_newrecord,
                'diffrenece_in_l'=>($pomp_newrecord-$diffence),
                'annex_id'=>$team_leader_annex,
                'name_of_saver'=>Auth::user()->name,
                'fuel_type'=>'diesel',
                'iddaily'=>$daily,
                'price_of_fuel' => $fuel_price,
            ));

            $thp = DB::table('tanks_has_pomps')->where('pomp_serial',$pomp_serial)->where('tank_fuel_type','diesel')->update([
                'last_record' => $pomp_newrecord
            ]);
        }

        foreach($searchQEssence91 as $pomp){ //diesel insert
            $pomp_serial = $pomp->pomp_serial;
                 $pomp_s = $request->input('es91'.$pomp_serial);
                 $pomp_newrecord = $request->input('es91'.$pomp_serial);
                 $diffence = DB::table('pomps')->where('serial',$pomp_serial)->first()->last_record;
                 $fuel_price = DB::table('fuel_price')->where('fuel_type','essence91')->first()->price;
                  //insertGetId
                $patrol = DB::table('patrol')->insert(array(
                    'date' =>$date,
                    'pomp_serial'=>$pomp_serial,
                    'new_record'=>$pomp_newrecord,
                    'diffrenece_in_l'=>($pomp_newrecord-$diffence),
                    'annex_id'=>$team_leader_annex,
                    'name_of_saver'=>Auth::user()->name,
                    'fuel_type'=>'essence91',
                    'iddaily'=>$daily,
                    'price_of_fuel' => $fuel_price,
                ));
    
                $thp = DB::table('tanks_has_pomps')->where('pomp_serial',$pomp_serial)->where('tank_fuel_type','essence91')->update([
                    'last_record' => $pomp_newrecord
                ]);
            }

            foreach($searchQEssence95 as $pomp){ //diesel insert
                $pomp_serial = $pomp->pomp_serial;
                     $pomp_s = $request->input('es95'.$pomp_serial);
                     $pomp_newrecord = $request->input('es95'.$pomp_serial);
                     $diffence = DB::table('pomps')->where('serial',$pomp_serial)->first()->last_record;
                     $fuel_price = DB::table('fuel_price')->where('fuel_type','essence95')->first()->price;
                      //insertGetId
                    $patrol = DB::table('patrol')->insert(array(
                        'date' =>$date,
                        'pomp_serial'=>$pomp_serial,
                        'new_record'=>$pomp_newrecord,
                        'diffrenece_in_l'=>($pomp_newrecord-$diffence),
                        'annex_id'=>$team_leader_annex,
                        'name_of_saver'=>Auth::user()->name,
                        'fuel_type'=>'essence95',
                        'iddaily'=>$daily,
                        'price_of_fuel' => $fuel_price,
                    ));
        
                    $thp = DB::table('tanks_has_pomps')->where('pomp_serial',$pomp_serial)->where('tank_fuel_type','essence95')->update([
                        'last_record' => $pomp_newrecord
                    ]);
                }

        // INDEPENDENT SECTION

         //get last table infos

         $atm = $request->input('atm');
         $retard = $request->input('retard');
         $impotence = $request->input('impotence');
         $total_cash = $request->input('totalofcash');
         $total_net = $request->input('nettotal');
         $notes = $request->input('notes');
         $iddaily = $daily;

         DB::table('patrol_summ')->insert(array(
            'atm' => $atm,
            'retard' => $retard,
            'impotence' => $impotence,
            'total_cash' => $total_cash,
            'notes' => $notes,
            'total' => $total_net,
            'iddaily' => $iddaily
         ));

        return view('patrol-add',['diesel_pomps'=>$searchQDiesel,'gas_pomps'=>$searchQGasoline],['es91_pomps'=>$searchQEssence91,'es95_pomps'=>$searchQEssence95]);
   
}

}