<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class showPatrolsForAnnexDirector extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function get(){
        if(isset($_GET['date'])){
            $Unsanitized_date = $_GET['date'];
            if(preg_match('/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/',$Unsanitized_date)){

                $official_date = $_GET['date'];
                $get_directors_email = Auth::user()->email;
                $get_annex_id = DB::table('annexes')->where('email',$get_directors_email)->first()->idannexes;
                $fuel_prices = DB::table('fuel_price')->get();

                if(DB::table('patrol')->where('annex_id',$get_annex_id)->where('date',$official_date)->get() != "[]"){

                $get_name_of_saver = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->name_of_saver;
                $last_table_infos_getting_iddaily = $get_gas_pomps = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('date',date("Y-m-d"))->first()->iddaily;
                $last_table_infos = DB::table('patrol_summ')->where('iddaily',$last_table_infos_getting_iddaily)->first();
                $get_tanks = DB::table('tanks')->where('annex_id',$get_annex_id)->get();

                $searchQGasoline = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$get_annex_id AND `fuel_type`='gasoline' ");
                $searchQDiesel = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$get_annex_id AND `fuel_type`='diesel' ");
        
                 $searchQEssence91 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$get_annex_id AND `fuel_type`='essence91'");
                 $searchQEssence95 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$get_annex_id AND `fuel_type`='essence95'");

                 if(DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily;
                }elseif(DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily;
                }elseif(DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily;
                }elseif(DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily;
                }    
                
                $daily_id = DB::table('daily')->where('iddaily',$last_table_infos_getting_iddaily)->first()->code;
        
        
                return view('patrol-edit',['id'=>$daily_id,'date'=>$official_date,'diesel_pomps'=>$searchQDiesel,'team_leader_annex'=>$get_annex_id,'gas_pomps'=>$searchQGasoline,'fuelprices'=>$fuel_prices],['es91_pomps'=>$searchQEssence91,'es95_pomps'=>$searchQEssence95,'last_table'=>$last_table_infos]);


                }else{
                    die('<center><b>لا يوجد تسجيل بلتاريخ المطلوب</b></center>');
                }

            }else{
                return redirect('/patrols');
            }
        
        
            }else{
                return view('choose-date-for-showing-patrols');
            }
    }

    public function post(Request $request){
        if(isset($_POST['date'])){
            $Unsanitized_date = $_POST['date'];
            if(preg_match('/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/',$Unsanitized_date)){
                $official_date = $_POST['date'];
                $get_directors_email = Auth::user()->email;
                $get_annex_id = DB::table('annexes')->where('email',$get_directors_email)->first()->idannexes;
                
                $total_liters_diesel = 0;

            $total_liters_gasoline = 0;

            $total_liters_es91 = 0;

            $total_liters_es95 = 0;
               

            if(DB::table('patrol')->where('annex_id',$get_annex_id)->where('date',$official_date)->get() != "[]"){
                $get_tanks = DB::table('tanks')->where('annex_id',$get_annex_id)->get();
                $searchQGasoline = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$get_annex_id AND `fuel_type`='gasoline' ");
                $searchQDiesel = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$get_annex_id AND `fuel_type`='diesel' ");
                $searchQEssence91 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$get_annex_id AND `fuel_type`='essence91'");
                $searchQEssence95 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id=$get_annex_id AND `fuel_type`='essence95'");


                if(DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily;
                }elseif(DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily;
                }elseif(DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily;
                }elseif(DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily;
                }    

                $daily_id_number = DB::table('daily')->where('iddaily',$last_table_infos_getting_iddaily)->first()->iddaily;
                
                $daily_id = DB::table('daily')->where('iddaily',$last_table_infos_getting_iddaily)->first()->code;

                foreach($searchQGasoline as $pomp){ //gasoline insert
                    $pomp_serial = $pomp->pomp_serial;
                         $pomp_s = $request->input('g'.$pomp_serial);
                         $pomp_newrecord = $request->input('g'.$pomp_serial);
                         $diffence = DB::table('pomps')->where('serial',$pomp_serial)->first()->last_record;
                         $fuel_price = DB::table('fuel_price')->where('fuel_type','gasoline')->first()->price;
                         $total_liters_gasoline += $pomp_newrecord*$fuel_price;
                          //insertGetId
                        $patrol = DB::table('patrol')->where('annex_id',$get_annex_id)->where('date',$official_date)->where('pomp_serial',$pomp_serial)->where('fuel_type','gasoline')->update([
                            'new_record'=>$pomp_newrecord,
                            'diffrenece_in_l'=>($pomp_newrecord-$diffence),
                            'name_of_saver'=>'تم التعديل عليه من طرف رئيس الفرع',
                            'fuel_type'=>'gasoline',
                            'price_of_fuel' => $fuel_price,
                        ]);
        
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
        
                     $total_liters_diesel += $pomp_newrecord*$fuel_price;
                      //insertGetId
                    $patrol = DB::table('patrol')->where('annex_id',$get_annex_id)->where('date',$official_date)->where('pomp_serial',$pomp_serial)->where('fuel_type','diesel')->update([
                        'new_record'=>$pomp_newrecord,
                        'diffrenece_in_l'=>($pomp_newrecord-$diffence),
                        'name_of_saver'=>'تم التعديل عليه من طرف رئيس الفرع',
                        'fuel_type'=>'diesel',
                        'price_of_fuel' => $fuel_price,
                    ]);
        
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
                         $total_liters_es91 += $pomp_newrecord*$fuel_price;
                          //insertGetId
                          $patrol = DB::table('patrol')->where('annex_id',$get_annex_id)->where('date',$official_date)->where('pomp_serial',$pomp_serial)->where('fuel_type','essence91')->update([
                            'new_record'=>$pomp_newrecord,
                            'diffrenece_in_l'=>($pomp_newrecord-$diffence),
                            'name_of_saver'=>'تم التعديل عليه من طرف رئيس الفرع',
                            'fuel_type'=>'essence91',
                            'price_of_fuel' => $fuel_price,
                        ]);
            
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
                             $total_liters_es95 += $pomp_newrecord*$fuel_price;
                              //insertGetId
                              $patrol = DB::table('patrol')->where('annex_id',$get_annex_id)->where('date',$official_date)->where('pomp_serial',$pomp_serial)->where('fuel_type','essence95')->update([
                                'new_record'=>$pomp_newrecord,
                                'diffrenece_in_l'=>($pomp_newrecord-$diffence),
                                'name_of_saver'=>'تم التعديل عليه من طرف رئيس الفرع',
                                'fuel_type'=>'essence95',
                                'price_of_fuel' => $fuel_price,
                            ]);
                
                
                            $thp = DB::table('tanks_has_pomps')->where('pomp_serial',$pomp_serial)->where('tank_fuel_type','essence95')->update([
                                'last_record' => $pomp_newrecord
                            ]);
                        }

                        $atm = $request->input('atm');
                        $retard = $request->input('retard');
                        $impotence = $request->input('impotence');
                        $total_cash = ($total_liters_gasoline+$total_liters_diesel+$total_liters_es91+$total_liters_es95) - ($atm+$retard);
                        $total_net = $request->input('nettotal');
                        $notes = $request->input('notes');
               
                        DB::table('patrol_summ')->where('iddaily',$daily_id_number)->update([
                           'atm' => $atm,
                           'retard' => $retard,
                           'total_cash' => $total_cash,
                        ]);
               
            }else{
                die('<center><b>لا يوجد تسجيل بلتاريخ المطلوب</b></center>');
            }

        }else{
            return redirect('/patrols');
        }
    }
}
}
