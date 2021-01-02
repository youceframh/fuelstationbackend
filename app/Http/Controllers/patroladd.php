<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class patroladd extends Controller
{
    public function __construct()
    {
        $this->middleware('teamleader'); 
    }
    public function get(){
        
        //date("Y-m-d", time() - 60 * 60 * 24);
        $fuel_prices = DB::table('fuel_price')->get();
        $team_leader_email = Auth::user()->email;
        $team_leader_annex = DB::table('employees')->where('email',$team_leader_email)->first()->annex_id;

      if(DB::table('patrol')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d"))->get() != "[]"){
          
        $get_name_of_saver;
        $official_date = date("Y-m-d");

        if(DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()){
            $get_name_of_saver = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->name_of_saver;
        }elseif(DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()){
            $get_name_of_saver = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->name_of_saver;
        }elseif(DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()){
            $get_name_of_saver = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->name_of_saver;
        }elseif(DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()){
            $get_name_of_saver = DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->name_of_saver;
        }

        $last_table_infos_getting_iddaily;

        if(DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d"))->first()){
            $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d"))->first()->iddaily;
        }elseif(DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d"))->first()){
            $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d"))->first()->iddaily;
        }elseif(DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d"))->first()){
            $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d"))->first()->iddaily;
        }elseif(DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d"))->first()){
            $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d"))->first()->iddaily;
        }
        
        $last_table_infos = DB::table('patrol_summ')->where('iddaily',$last_table_infos_getting_iddaily)->first();
        $get_gas_pomps = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d"))->get();
        $get_diesel_pomps = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d"))->get();
        $get_es91_pomps = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d"))->get();
        $get_es95_pomps = DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$team_leader_annex)->where('date',date("Y-m-d"))->get();

        global $diesel_tanks_left;
        global $gasoline_tanks_left;
        global $essence91_tanks_left;
        global $essence95_tanks_left;
        
        if(DB::table('tanks')->where('annex_id',$team_leader_annex)->where('fuel_type','diesel')->get() != '[]'){
            $diesel_tanks_left = DB::table('tanks')->where('annex_id',$team_leader_annex)->where('fuel_type','diesel')->get();
        }
        if(DB::table('tanks')->where('annex_id',$team_leader_annex)->where('fuel_type','gasoline')->get() != '[]'){
            $gasoline_tanks_left = DB::table('tanks')->where('annex_id',$team_leader_annex)->where('fuel_type','gasoline')->get();
        }
        if(DB::table('tanks')->where('annex_id',$team_leader_annex)->where('fuel_type','essence91')->get() != '[]'){
            $essence91_tanks_left = DB::table('tanks')->where('annex_id',$team_leader_annex)->where('fuel_type','essence91')->get();
        }
        if(DB::table('tanks')->where('annex_id',$team_leader_annex)->where('fuel_type','essence95')->get() != '[]'){
            $essence95_tanks_left = DB::table('tanks')->where('annex_id',$team_leader_annex)->where('fuel_type','essence95')->get();
        }

        return view('patrol-show',['diesel_tanks_left'=>$diesel_tanks_left,'gasoline_tanks_left'=>$gasoline_tanks_left,'essence91_tanks_left'=>$essence91_tanks_left,'essence95_tanks_left'=>$essence95_tanks_left,'diesel_pomps'=>$get_diesel_pomps,'saver_name'=> $get_name_of_saver,'team_leader_annex'=>$team_leader_annex,'gas_pomps'=>$get_gas_pomps,'fuelprices'=>$fuel_prices,'last_table'=>$last_table_infos],['es91_pomps'=>$get_es91_pomps,'es95_pomps'=>$get_es95_pomps]);
      }else{
         
        $team_leader_email = Auth::user()->email;
        $team_leader_annex = DB::table('employees')->where('email',$team_leader_email)->first()->annex_id;
        $get_tanks = DB::table('tanks')->where('annex_id',$team_leader_annex)->get();
        $get_repayment = DB::table('addfuelrepayment_and_addfuel_infos')->where('annex_id',$team_leader_annex)->where('date_of_last_addition',date('Y-m-d'))->get();

        $searchQGasoline = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$team_leader_annex AND annex_id=$team_leader_annex AND `fuel_type`='gasoline' AND `status`=1 ");
        $searchQDiesel = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$team_leader_annex AND annex_id=$team_leader_annex AND `fuel_type`='diesel'  AND `status`=1 ");

         $searchQEssence91 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$team_leader_annex AND annex_id=$team_leader_annex AND `fuel_type`='essence91'  AND `status`=1 ");
         $searchQEssence95 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$team_leader_annex AND annex_id=$team_leader_annex AND `fuel_type`='essence95'  AND `status`=1");

        return view('patrol-add',['repayments'=>$get_repayment,'diesel_pomps'=>$searchQDiesel,'team_leader_annex'=>$team_leader_annex,'gas_pomps'=>$searchQGasoline,'fuelprices'=>$fuel_prices],['es91_pomps'=>$searchQEssence91,'es95_pomps'=>$searchQEssence95]);
    
      }
        
    }
    public function post(Request $request){

        $validation = $request->validate([
            'atm' => ['required','digits_between:1,99999999999'],
            'retard' => ['nullable','digits_between:1,99999999999'],
            'repayment' => ['required','digits_between:1,99999999999'],
            'repayment_desc' => ['required','string'],
        ]);

        $atm = $request->input('atm');
        $retard = $request->input('retard');
        $repayment = $request->input('repayment');
        $repayment_desc = $request->input('repayment_desc');


        $fuel_prices = DB::table('fuel_price')->get();
        $team_leader_email = Auth::user()->email;
        $team_leader_annex = DB::table('employees')->where('email',$team_leader_email)->first()->annex_id;
        $searchQGasoline = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$team_leader_annex AND annex_id=$team_leader_annex AND `fuel_type`='gasoline' ");
        $searchQDiesel = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$team_leader_annex AND annex_id=$team_leader_annex AND `fuel_type`='diesel' ");

         $searchQEssence91 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$team_leader_annex AND annex_id=$team_leader_annex AND `fuel_type`='essence91'");
         $searchQEssence95 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$team_leader_annex AND annex_id=$team_leader_annex AND `fuel_type`='essence95'");

        $request->validate([
            'atm' => ['required','digits_between:0,999999999129294']
        ]);

        $total_liters_diesel = 0;

            $total_liters_gasoline = 0;

            $total_liters_es91 = 0;

            $total_liters_es95 = 0;

        $date =  date('Y-m-d');
        function randomPassword() {
            $alphabet = '01234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i <= 14; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass); //turn the array into a string
        }

        $team_leader_email = Auth::user()->email;
        $team_leader_annex = DB::table('employees')->where('email',$team_leader_email)->first()->annex_id;
        $get_annex_name = DB::table('annexes')->where('idannexes',$team_leader_annex)->first()->name;
        
        $daily_code = strtoupper(substr($get_annex_name,0,2));

        $daily = DB::table('daily')->insertGetId(array(
            'iddaily' => null,
            'timing' => $date,
            'code' => $daily_code.randomPassword(),  
            'annex_id'=> $team_leader_annex
        ));


    if($searchQGasoline != '[]'){
        foreach($searchQGasoline as $pomp){ //gasoline insert
            $pomp_serial = $pomp->pomp_serial;
            $pomp_newrecord = filter_var($request->input('g'.$pomp_serial),FILTER_SANITIZE_NUMBER_INT);
                 $diffence = DB::table('pomps')->where('serial',$pomp_serial)->first()->last_record;
                 $fuel_price = DB::table('fuel_price')->where('fuel_type','gasoline')->first()->price;
                 $total_liters_gasoline += $pomp_newrecord*$fuel_price;
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
    }

            
       
            
if($searchQDiesel != '[]'){
    foreach($searchQDiesel as $pomp){ //diesel insert
        $pomp_serial = $pomp->pomp_serial;
        $pomp_newrecord = filter_var($request->input('d'.$pomp_serial),FILTER_SANITIZE_NUMBER_INT);
             $diffence = DB::table('pomps')->where('serial',$pomp_serial)->first()->last_record;
             $fuel_price = DB::table('fuel_price')->where('fuel_type','diesel')->first()->price;

             $total_liters_diesel += $pomp_newrecord*$fuel_price;
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
}

   

        if($searchQEssence91 != '[]'){
            foreach($searchQEssence91 as $pomp){ //diesel insert
                $pomp_serial = $pomp->pomp_serial;
                $pomp_newrecord = filter_var($request->input('es91'.$pomp_serial),FILTER_SANITIZE_NUMBER_INT);
                     $diffence = DB::table('pomps')->where('serial',$pomp_serial)->first()->last_record;
                     $fuel_price = DB::table('fuel_price')->where('fuel_type','essence91')->first()->price;
                     $total_liters_es91 += $pomp_newrecord*$fuel_price;
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
        }

       

            if($searchQEssence95 != '[]'){
                foreach($searchQEssence95 as $pomp){ //diesel insert
                    $pomp_serial = $pomp->pomp_serial;
                         $pomp_newrecord = filter_var($request->input('es95'.$pomp_serial),FILTER_SANITIZE_NUMBER_INT);
                         $diffence = DB::table('pomps')->where('serial',$pomp_serial)->first()->last_record;
                         $fuel_price = DB::table('fuel_price')->where('fuel_type','essence95')->first()->price;
                         $total_liters_es95 += $pomp_newrecord*$fuel_price;
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
    
            }

           
        // INDEPENDENT SECTION

         //get last table infos

         $total_cash = ($total_liters_gasoline+$total_liters_diesel+$total_liters_es91+$total_liters_es95) - ($atm+$retard+$repayment);
         $iddaily = $daily;

         DB::table('patrol_summ')->insert(array(
            'atm' => $atm,
            'retard' => $retard,
            'impotence' => null,
            'total_cash' => $total_cash,
            'notes' => null,
            'total' => null,
            'repayment' => $repayment,
            'repayment_desc' => $repayment_desc,
            'iddaily' => $iddaily
         ));

         return redirect('/patrol/show');
}

}
