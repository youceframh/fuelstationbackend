<?php

namespace App\Http\Controllers;
use \Illuminate\Exceptions\check_last_record;
use Auth;
use DB;


use Illuminate\Http\Request;

class registerpatrolF extends Controller
{
    public function __construct()
    {
        $this->middleware('teamleader'); // restricting this page for companies only
        //make special middleware for teamleader and add row in db 
    }

    public function get(){
        $todaysdate = date('Y-m-d');
        $get_user_email = Auth::user()->email;
        $get_annex_id = DB::table('employees')->where('email',$get_user_email)->first()->annex_id;
        $getpomps = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND last_approach != $todaysdate");
    if($getpomps != "[]"){
        return view('register_patrol_full', ['pomps' => $getpomps]); //sending tanks to user
    }else{
        die("<center><h1>سجل خزان اولا</h1></center>");
    }

       
    }

    public function post(Request $req){
        
        $get_user_email = Auth::user()->email;
        $todaysdate = date('Y-m-d');
        $get_annex_id = DB::table('employees')->where('email',$get_user_email)->first()->annex_id;
        $getpomps = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND last_approach != $todaysdate"); 
       global $success;
        $success = 0;

        function insert($pmp_serial,$pmp_type,$new_record){
            $todaysdate = date('Y-m-d');
            $get_user_email = Auth::user()->email;
            $get_annex_id = DB::table('employees')->where('email',$get_user_email)->first()->annex_id;
            $tank_nbr = DB::table('tanks_has_pomps')->where('pomp_serial',$pmp_serial)->where('tank_fuel_type',$pmp_type)->where('tank_annex_id',$get_annex_id)->first()->tank_id;
            $getpomps = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND last_approach != $todaysdate");  
            $get_last_insert_value = DB::table('patrol_transitional')->where('pomp_serial',$pmp_serial)->where('tank_fuel_type',$pmp_type)->where('annex_id',$get_annex_id)->first();

            $check_if_pomp_exists = DB::table('patrol_transitional')->where('pomp_serial',$pmp_serial)->where('tank_fuel_type',$pmp_type)->where('annex_id',$get_annex_id)->get();
            if($check_if_pomp_exists != '[]'){
                try {                       
               $insertDB = DB::table('patrol_transitional')->where('pomp_serial',$pmp_serial)->where('tank_fuel_type',$pmp_type)->where('annex_id',$get_annex_id)->update([ //inserting into db
                    'new_record'=>$new_record,
                ]);
               } catch(\Illuminate\Database\QueryException $ex){ 
                die('حاول لاحقا'); 
                // Note any method of class PDOException can be called on $ex.
              }
            }else{
                try { 
                $insertDB = DB::table('patrol_transitional')->insert( array ( //inserting into db
                    'id' => null,
                    'tank_id'=>$tank_nbr,
                    'annex_id'=>$get_annex_id,  
                    'pomp_serial'=>$pmp_serial,
                    'new_record'=>$new_record,
                    'tank_fuel_type'=>$pmp_type,
                ));
            } catch(\Illuminate\Database\QueryException $ex){ 
                die('حاول لاحقا'); 
                // Note any method of class PDOException can be called on $ex.
              }
            }

        }

        foreach($getpomps as $pomp){
            $fuel_type = $pomp->tank_fuel_type;
            switch($fuel_type){
                case 'diesel':
                    $getDieselPomp = $req->input('d'.$pomp->pomp_serial);
                    if($getDieselPomp == ''){
                        return view('register_patrol_full', ['pomps' => $getpomps,'failed'=>'سجل كل الخانات من فظلك']);
                    }else{
                        $pomp_serial = $pomp->pomp_serial;
                        $pomp_type = 'diesel';
                        $get_last_insert_value = DB::table('patrol_transitional')->where('pomp_serial',$pomp_serial)->where('tank_fuel_type',$pomp_type)->where('annex_id',$get_annex_id)->first();
                        if($get_last_insert_value){
                            if(($getDieselPomp) <= ($get_last_insert_value->new_record)){
                                return view('register_patrol_full', ['pomps' => $getpomps,'failed'=>"لا يمكنك تسجيل قيمة اقل من القيمة المدخلة سابقا في $pomp_serial"]);
                            }else{
                            insert($pomp_serial,$pomp_type,$getDieselPomp);
                        }
                        }else{
                            insert($pomp_serial,$pomp_type,$getDieselPomp);
                        }
                        $success = 4;
                    }
                break;
        
                case 'gasoline':
                    $getGasPomp = $req->input('g'.$pomp->pomp_serial);
                    if($getGasPomp == ''){
                        return view('register_patrol_full', ['pomps' => $getpomps,'failed'=>'سجل كل الخانات من فظلك']);
                    }else{
                        $pomp_serial = $pomp->pomp_serial;
                        $pomp_type = 'gasoline';
                        $get_last_insert_value = DB::table('patrol_transitional')->where('pomp_serial',$pomp_serial)->where('tank_fuel_type',$pomp_type)->where('annex_id',$get_annex_id)->first();
                        if($get_last_insert_value){
                            if(($getGasPomp) <= ($get_last_insert_value->new_record)){
                                return view('register_patrol_full', ['pomps' => $getpomps,'failed'=>"لا يمكنك تسجيل قيمة اقل من القيمة المدخلة سابقا في $pomp_serial"]);
                            }else{
                            insert($pomp_serial,$pomp_type,$getGasPomp);
                        }
                        }else{insert($pomp_serial,$pomp_type,$getGasPomp);}
                        $success = 4;
                    }
                break;
                case 'essence91':
                    $getEs91Pomp = $req->input('es91'.$pomp->pomp_serial);
                    if($getEs91Pomp == ''){
                        return view('register_patrol_full', ['pomps' => $getpomps,'failed'=>'سجل كل الخانات من فظلك']);
                    }else{
                        $pomp_serial = $pomp->pomp_serial;
                        $pomp_type = 'essence91';
                        $get_last_insert_value = DB::table('patrol_transitional')->where('pomp_serial',$pomp_serial)->where('tank_fuel_type',$pomp_type)->where('annex_id',$get_annex_id)->first();
                        if($get_last_insert_value){
                            if(($getEs91Pomp) <= ($get_last_insert_value->new_record)){
                                return view('register_patrol_full', ['pomps' => $getpomps,'failed'=>"لا يمكنك تسجيل قيمة اقل من القيمة المدخلة سابقا في $pomp_serial"]);
                            }else{
                            insert($pomp_serial,$pomp_type,$getEs91Pomp);
                        }
                        }else{
                            insert($pomp_serial,$pomp_type,$getEs91Pomp);
                        }
                        $success = 4;
                    }
                break;
                case 'essence95':
                    $getEs95Pomp = $req->input('es95'.$pomp->pomp_serial);
                    if($getEs95Pomp == ''){
                        return view('register_patrol_full', ['pomps' => $getpomps,'failed'=>'سجل كل الخانات من فظلك']);
                    }else{
                        $pomp_serial = $pomp->pomp_serial;
                        $pomp_type = 'essence95';
                        $get_last_insert_value = DB::table('patrol_transitional')->where('pomp_serial',$pomp_serial)->where('tank_fuel_type',$pomp_type)->where('annex_id',$get_annex_id)->first();
                        if($get_last_insert_value){
                            if(($getEs95Pomp) <= ($get_last_insert_value->new_record)){
                                return view('register_patrol_full', ['pomps' => $getpomps,'failed'=>"لا يمكنك تسجيل قيمة اقل من القيمة المدخلة سابقا في $pomp_serial"]);
                            }else{
                            insert($pomp_serial,$pomp_type,$getEs95Pomp);
                        }
                        }else{insert($pomp_serial,$pomp_type,$getEs95Pomp);}
                        
                        $success = 4;
                    }
                break;
            }
        }

        if($success == 4){
            return view('register_patrol_full', ['pomps' => $getpomps,'success'=>'تم التسجيل بنجاح']);
        }else{
            return view('register_patrol_full', ['pomps' => $getpomps,'failed'=>'اعد المحاولة']);
        }
    
    }
}
