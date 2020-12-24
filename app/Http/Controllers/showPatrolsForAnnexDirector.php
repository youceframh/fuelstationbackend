<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class showPatrolsForAnnexDirector extends Controller
{
    public function __construct()
    {
        $this->middleware('annex');
        
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

                    $get_name_of_saver;

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
                if(DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily;
                }elseif(DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily;
                }elseif(DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily;
                }elseif(DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily;
                }    

                $last_table_infos = DB::table('patrol_summ')->where('iddaily',$last_table_infos_getting_iddaily)->first();
                $get_tanks = DB::table('tanks')->where('annex_id',$get_annex_id)->get();

                $searchQGasoline = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='gasoline' ");
                $searchQDiesel = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='diesel' ");
        
                 $searchQEssence91 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='essence91'");
                 $searchQEssence95 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='essence95'");

                 if(DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily;
                }elseif(DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily;
                }elseif(DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()->iddaily;
                }elseif(DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('date',$official_date)->first()){
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
        
        if(isset($_POST['date'])){
            $Unsanitized_date = $_POST['date'];
            if(preg_match('/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/',$Unsanitized_date)){
                $official_date = $_POST['date'];
                $get_directors_email = Auth::user()->email;
                $get_annex_id = DB::table('annexes')->where('email',$get_directors_email)->first()->idannexes;
                $id_an  = $get_annex_id  ;
    
                if(isset($_POST['patrol'])){
                    $get_all_unconfirmed_patrols = DB::table('daily')->where('annex_id',$id_an)->get();
                    if(preg_match("/^[A-Za-z0-9]+$/", $_POST['patrol'])){
            
                        $official_code_of_patrol = $_POST['patrol'];
                        
                        if(DB::table('daily')->where('annex_id',$get_annex_id)->where('code',$official_code_of_patrol)->get() != '[]'){
                            $patrol_id = DB::table('daily')->where('annex_id',$id_an)->where('code',$official_code_of_patrol)->first()->iddaily;
                            $total_liters_diesel = 0;
    
                            $total_liters_gasoline = 0;
                    
                            $total_liters_es91 = 0;
                    
                            $total_liters_es95 = 0;
                               
                    
                            if(DB::table('patrol')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->get() != "[]"){
                                $get_tanks = DB::table('tanks')->where('annex_id',$get_annex_id)->get();
                               
                $searchQGasoline = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='gasoline' ");
                $searchQDiesel = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='diesel' ");
        
                 $searchQEssence91 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='essence91'");
                 $searchQEssence95 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='essence95'");
                    
                    
                                if(DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
                                }elseif(DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
                                }elseif(DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
                                }elseif(DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
                                }    
                    
                                $daily_id_number = DB::table('daily')->where('iddaily',$last_table_infos_getting_iddaily)->first()->iddaily;
                                
                                $daily_id = DB::table('daily')->where('iddaily',$last_table_infos_getting_iddaily)->first()->code;
                    
                                if($searchQGasoline != '[]'){
                                    foreach($searchQGasoline as $pomp){ //gasoline insert
                                        $pomp_serial = $pomp->pomp_serial;
                                             $pomp_newrecord = filter_var($request->input('g'.$pomp_serial),FILTER_SANITIZE_NUMBER_INT);
                                             $diffence = DB::table('pomps')->where('serial',$pomp_serial)->first()->last_record;
                                             $fuel_price = DB::table('fuel_price')->where('fuel_type','gasoline')->first()->price;
                                             $total_liters_gasoline += $pomp_newrecord*$fuel_price;
                                              //insertGetId
                                            $patrol = DB::table('patrol')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('pomp_serial',$pomp_serial)->where('fuel_type','gasoline')->update([
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
                                }
                    
                                
                                if($searchQDiesel != '[]'){
                                    foreach($searchQDiesel as $pomp){ //diesel insert
                                        $pomp_serial = $pomp->pomp_serial;
                                        $pomp_newrecord = filter_var($request->input('d'.$pomp_serial),FILTER_SANITIZE_NUMBER_INT);
                                             $diffence = DB::table('pomps')->where('serial',$pomp_serial)->first()->last_record;
                                             $fuel_price = DB::table('fuel_price')->where('fuel_type','diesel')->first()->price;
                                
                                             $total_liters_diesel += $pomp_newrecord*$fuel_price;
                                              //insertGetId
                                            $patrol = DB::table('patrol')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('pomp_serial',$pomp_serial)->where('fuel_type','diesel')->update([
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
                                }
                                    
                                if($searchQEssence91 != '[]'){
                                    foreach($searchQEssence91 as $pomp){ //diesel insert
                                        $pomp_serial = $pomp->pomp_serial;
                                        $pomp_newrecord = filter_var($request->input('es91'.$pomp_serial),FILTER_SANITIZE_NUMBER_INT);
                                             $diffence = DB::table('pomps')->where('serial',$pomp_serial)->first()->last_record;
                                             $fuel_price = DB::table('fuel_price')->where('fuel_type','essence91')->first()->price;
                                             $total_liters_es91 += $pomp_newrecord*$fuel_price;
                                              //insertGetId
                                              $patrol = DB::table('patrol')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('pomp_serial',$pomp_serial)->where('fuel_type','essence91')->update([
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
                                }
                           
                        
                                if($searchQEssence95 != '[]'){
                                    foreach($searchQEssence95 as $pomp){ //diesel insert
                                        $pomp_serial = $pomp->pomp_serial;
                                        $pomp_newrecord = filter_var($request->input('es95'.$pomp_serial),FILTER_SANITIZE_NUMBER_INT);
                                             $diffence = DB::table('pomps')->where('serial',$pomp_serial)->first()->last_record;
                                             $fuel_price = DB::table('fuel_price')->where('fuel_type','essence95')->first()->price;
                                             $total_liters_es95 += $pomp_newrecord*$fuel_price;
                                              //insertGetId
                                              $patrol = DB::table('patrol')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('pomp_serial',$pomp_serial)->where('fuel_type','essence95')->update([
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
                                }
                        
                                        $total_cash = ($total_liters_gasoline+$total_liters_diesel+$total_liters_es91+$total_liters_es95) - ($atm+$retard);

                               
                                        DB::table('patrol_summ')->where('iddaily',$daily_id_number)->update([
                                           'atm' => $atm,
                                           'retard' => $retard,
                                           'total_cash' => $total_cash,
                                           'repayment' => $repayment,
                                           'repayment_desc' => $repayment_desc,
                                        ]);
                    
                                        return redirect("/patrols?date=".$_POST['date']);
                               
                            }else{
                                die('<center><b>لا يوجد تسجيل بلرقم المطلوب</b></center>');
                            }
                    
                        }else{
                            die('<center><h1>لا يمكنك التعديل على ورديات لا تخصك</h1></center>');
                        }
                    }else{
                        return redirect('/patrols');
                    }
                        }
                    }
                    
                }
      }

  public function getAll(){
      $director_email = Auth::user()->email;
      $id_an = DB::table('annexes')->where('email',$director_email)->first()->idannexes;
    if(isset($_GET['searchquery'])){ //search by patrol dailyid
        if(preg_match("/^[a-zA-Z0-9 ]+$/", $_GET['searchquery'])){
            $get_all_unconfirmed_patrols = DB::table('daily')->where('annex_id',$id_an)->where('code',$_GET['searchquery'])->get();
            return view('show-unconfirmed-patrols',['patrols'=>$get_all_unconfirmed_patrols]);
        } else {
            $get_all_unconfirmed_patrols = DB::table('daily')->where('annex_id',$id_an)->get();
            return view('show-unconfirmed-patrols',['patrols'=>$get_all_unconfirmed_patrols]);
        }
    }elseif(isset($_GET['patrol'])){
        $get_all_unconfirmed_patrols = DB::table('daily')->where('annex_id',$id_an)->get();
        if(preg_match("/^[A-Za-z0-9]+$/", $_GET['patrol'])){

            $official_code_of_patrol = $_GET['patrol'];
            $patrol_id = DB::table('daily')->where('annex_id',$id_an)->where('code',$official_code_of_patrol)->first()->iddaily;
            
            $get_directors_email = Auth::user()->email;
            $get_annex_id = DB::table('annexes')->where('email',$get_directors_email)->first()->idannexes;
            $fuel_prices = DB::table('fuel_price')->get();

            if(DB::table('patrol')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->get() != "[]"){

                $get_name_of_saver;

                if(DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                    $get_name_of_saver = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->name_of_saver;
                }elseif(DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                    $get_name_of_saver = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->name_of_saver;
                }elseif(DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                    $get_name_of_saver = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->name_of_saver;
                }elseif(DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('date',$official_date)->first()){
                    $get_name_of_saver = DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->name_of_saver;
                }

            $last_table_infos_getting_iddaily;
            if(DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','gasoline')->where('iddaily',$patrol_id)->where('iddaily',$patrol_id)->first()->iddaily;
            }elseif(DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
            }elseif(DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
            }elseif(DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
            }    

            $last_table_infos = DB::table('patrol_summ')->where('iddaily',$last_table_infos_getting_iddaily)->first();
            $get_tanks = DB::table('tanks')->where('annex_id',$get_annex_id)->get();

           
            $searchQGasoline = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='gasoline' ");
            $searchQDiesel = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='diesel' ");
    
             $searchQEssence91 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='essence91'");
             $searchQEssence95 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='essence95'");

             if(DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
            }elseif(DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
            }elseif(DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
            }elseif(DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
            }    
            
            $daily_id = DB::table('daily')->where('iddaily',$last_table_infos_getting_iddaily)->first()->code;
            $official_date = DB::table('daily')->where('iddaily',$patrol_id)->first()->timing;
    
    
            return view('patrol-edit',['id'=>$daily_id,'date'=>$official_date,'diesel_pomps'=>$searchQDiesel,'team_leader_annex'=>$get_annex_id,'gas_pomps'=>$searchQGasoline,'fuelprices'=>$fuel_prices],['es91_pomps'=>$searchQEssence91,'es95_pomps'=>$searchQEssence95,'last_table'=>$last_table_infos]);


            }else{
                die('<center><b>لا يوجد تسجيل بلتاريخ المطلوب</b></center>');
            }

        }else{  

            return view('show-unconfirmed-patrols',['patrols'=>$get_all_unconfirmed_patrols]);}
        
    }else{ //show all unconfirmed patrols
        $get_all_unconfirmed_patrols = DB::table('daily')->where('annex_id',$id_an)->get();
        return view('show-unconfirmed-patrols',['patrols'=>$get_all_unconfirmed_patrols]);
    }
  }

  public function postAll(Request $request){

    
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
    


    if(isset($_POST['date'])){
        $Unsanitized_date = $_POST['date'];
        if(preg_match('/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/',$Unsanitized_date)){
            $official_date = $_POST['date'];
            $get_directors_email = Auth::user()->email;
            $get_annex_id = DB::table('annexes')->where('email',$get_directors_email)->first()->idannexes;
            $id_an  = $get_annex_id;

            if(isset($_POST['patrol'])){
                $get_all_unconfirmed_patrols = DB::table('daily')->where('annex_id',$id_an)->get();
                if(preg_match("/^[A-Za-z0-9]+$/", $_POST['patrol'])){
        
                    $official_code_of_patrol = $_POST['patrol'];
                    $patrol_id = DB::table('daily')->where('annex_id',$id_an)->where('code',$official_code_of_patrol)->first()->iddaily;

                    dd(DB::table('daily')->where('annex_id',$get_annex_id)->where('code',$official_code_of_patrol)->get());
                    
                    if(DB::table('daily')->where('annex_id',$get_annex_id)->where('code',$official_code_of_patrol)->get() != '[]'){
                        $total_liters_diesel = 0;

                        $total_liters_gasoline = 0;
                
                        $total_liters_es91 = 0;
                
                        $total_liters_es95 = 0;
                           
                
                        if(DB::table('patrol')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->get() != "[]"){
                            $get_tanks = DB::table('tanks')->where('annex_id',$get_annex_id)->get();
                            
                $searchQGasoline = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='gasoline' ");
                $searchQDiesel = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='diesel' ");
        
                 $searchQEssence91 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='essence91'");
                 $searchQEssence95 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='essence95'");
                
                
                            if(DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                                $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
                            }elseif(DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                                $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
                            }elseif(DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                                $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
                            }elseif(DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                                $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
                            }    
                
                            $daily_id_number = DB::table('daily')->where('iddaily',$last_table_infos_getting_iddaily)->first()->iddaily;
                            
                            $daily_id = DB::table('daily')->where('iddaily',$last_table_infos_getting_iddaily)->first()->code;
                
                            if($searchQGasoline != '[]'){
                                foreach($searchQGasoline as $pomp){ //gasoline insert
                                    $pomp_serial = $pomp->pomp_serial;
                                       $pomp_newrecord = filter_var($request->input('g'.$pomp_serial),FILTER_SANITIZE_NUMBER_INT);
                                         $diffence = DB::table('pomps')->where('serial',$pomp_serial)->first()->last_record;
                                         $fuel_price = DB::table('fuel_price')->where('fuel_type','gasoline')->first()->price;
                                         $total_liters_gasoline += $pomp_newrecord*$fuel_price;
                                          //insertGetId
                                        $patrol = DB::table('patrol')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('pomp_serial',$pomp_serial)->where('fuel_type','gasoline')->update([
                                            'new_record'=>$pomp_newrecord,
                                            'diffrenece_in_l'=>($pomp_newrecord-$diffence),
                                            'name_of_saver'=>'2تم التعديل عليه من طرف رئيس الفرع',
                                            'fuel_type'=>'gasoline',
                                            'price_of_fuel' => $fuel_price,
                                        ]);
                        
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
                                        $patrol = DB::table('patrol')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('pomp_serial',$pomp_serial)->where('fuel_type','diesel')->update([
                                            'new_record'=>$pomp_newrecord,
                                            'diffrenece_in_l'=>($pomp_newrecord-$diffence),
                                            'name_of_saver'=>'2تم التعديل عليه من طرف رئيس الفرع',
                                            'fuel_type'=>'diesel',
                                            'price_of_fuel' => $fuel_price,
                                        ]);
                            
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
                                          $patrol = DB::table('patrol')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('pomp_serial',$pomp_serial)->where('fuel_type','essence91')->update([
                                            'new_record'=>$pomp_newrecord,
                                            'diffrenece_in_l'=>($pomp_newrecord-$diffence),
                                            'name_of_saver'=>'2تم التعديل عليه من طرف رئيس الفرع',
                                            'fuel_type'=>'essence91',
                                            'price_of_fuel' => $fuel_price,
                                        ]);
                            
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
                                          $patrol = DB::table('patrol')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('pomp_serial',$pomp_serial)->where('fuel_type','essence95')->update([
                                            'new_record'=>$pomp_newrecord,
                                            'diffrenece_in_l'=>($pomp_newrecord-$diffence),
                                            'name_of_saver'=>'2تم التعديل عليه من طرف رئيس الفرع',
                                            'fuel_type'=>'essence95',
                                            'price_of_fuel' => $fuel_price,
                                        ]);
                            
                            
                                        $thp = DB::table('tanks_has_pomps')->where('pomp_serial',$pomp_serial)->where('tank_fuel_type','essence95')->update([
                                            'last_record' => $pomp_newrecord
                                        ]);
                                    }
                            }
                    
                               
                        
                                    $total_cash = ($total_liters_gasoline+$total_liters_diesel+$total_liters_es91+$total_liters_es95) - ($atm+$retard);
                           
                                    DB::table('patrol_summ')->where('iddaily',$daily_id_number)->update([
                                       'atm' => $atm,
                                       'retard' => $retard,
                                       'total_cash' => $total_cash,
                                       'repayment' => $repayment,
                                       'repayment_desc' => $repayment_desc,
                                    ]);
                
                                    return redirect("/patrols?date=".$_POST['date']);
                           
                        }else{
                            die('<center><b>لا يوجد تسجيل بلرقم المطلوب</b></center>');
                        }
                
                    }else{
                        die('<center><h1>لا يمكنك التعديل على ورديات لا تخصك</h1></center>');
                    }
                }else{
                    return redirect('/patrols');
                }
                    }
                }
                
            }
  }

}
