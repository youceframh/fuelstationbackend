<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class registerpatrol extends Controller
{
    public function __construct()
    {
        $this->middleware('teamleader'); // restricting this page for companies only
        //make special middleware for teamleader and add row in db 
    }

    public function get(){
        $todaysdate = date('Y-m-d');
        if(isset($_GET['pompserial'])){ //getting pomp serial
            $pompserialandtype = explode('&',$_GET['pompserial']);
            $checkPompSerial = preg_match("/^[a-zA-Z0-9]+$/", $pompserialandtype[0]);
            $checkPompFueltype = preg_match("/^[a-zA-Z0-9]+$/", $pompserialandtype[1]);
            if(!$checkPompSerial && !$checkPompFueltype){ //checkinf for sql injection
                die('<center><h1>الخزان الذي تبحث عنه غير موجود</h1></center>');
            }else{

                $get_user_email = Auth::user()->email;
            $get_annex_id = DB::table('employees')->where('email',$get_user_email)->first()->annex_id;
               
            //get all pomps

            $getpomps = DB::select('SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id='.$get_annex_id.' AND pomp_serial='."'$pompserialandtype[0]'".' AND tank_fuel_type='."'$pompserialandtype[1]'");
            
            return view('register-patrol',['pomp_serial' => $getpomps]);

            }
        
        }else{
            $get_user_email = Auth::user()->email;
            $get_annex_id = DB::table('employees')->where('email',$get_user_email)->first()->annex_id;
            $getpomps = DB::select('SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id='.$get_annex_id.' AND last_approach !='."'$todaysdate'");
        if($getpomps != "[]"){
            return view('choose-pomp', ['pomps' => $getpomps]); //sending tanks to user
        }else{
            die("<center><h1>سجل خزان اولا</h1></center>");
        }
        
    }
}
    public function post(Request $request){ 
        $todaysdate = date('Y-m-d');
        $get_user_email = Auth::user()->email;
        $get_annex_id = DB::table('employees')->where('email',$get_user_email)->first()->annex_id;
        $pompserialandtype = explode('&',$_POST['pomp']);
        $checkPompSerial = preg_match("/^[a-zA-Z0-9]+$/", $pompserialandtype[0]);
        $checkPompFueltype = preg_match("/^[a-zA-Z0-9]+$/", $pompserialandtype[1]);

        $validate = $request->validate([ //validating inputs
            'lastrecord' => ['required','numeric'],
            'newrecord' => ['required','numeric'],
            'atm' => ['nullable','numeric'],
            'retard' => ['nullable','numeric'],
        ]);
    
        
        if(!$checkPompSerial && !$checkPompFueltype){ //checkinf for sql injection
            die('<center><h1>الخزان الذي تبحث عنه غير موجود</h1></center>');
        }else{

            //setting vars

            $pmp_serial = $pompserialandtype[0];
            $pmp_type = $pompserialandtype[1];

            $pomp_serial = $_POST['pomp'];
            $last_record = $request->input('lastrecord');
            $new_record = $request->input('newrecord');
            $atm = $request->input('atm');
            $retard = $request->input('retard');
            $tank_nbr = DB::table('tanks_has_pomps')->where('pomp_serial',$pompserialandtype[0])->where('tank_fuel_type',$pompserialandtype[1])->first()->tank_id;

            $check_if_pomp_exists = DB::table('patrol_transitional')->where('pomp_serial',$pmp_serial)->where('tank_fuel_type',$pmp_type)->get();
            
            if($check_if_pomp_exists != '[]'){
               
                $insertDB = DB::table('patrol_transitional')->where('pomp_serial',$pmp_serial)->update([ //inserting into db
                    'tank_id'=>$tank_nbr,
                    'annex_id'=>$get_annex_id,  
                    'pomp_serial'=>$pmp_serial,
                    'new_record'=>$new_record,
                    'tank_fuel_type'=>$pmp_type,
                    'atm'=>$atm,
                    'retard'=>$retard,
                ]);
            }else{
                $insertDB = DB::table('patrol_transitional')->insert( array ( //inserting into db
                    'id' => null,
                    'tank_id'=>$tank_nbr,
                    'annex_id'=>$get_annex_id,  
                    'pomp_serial'=>$pompserialandtype[0],
                    'new_record'=>$new_record,
                    'tank_fuel_type'=>$pompserialandtype[1],
                    'atm'=>$atm,
                    'retard'=>$retard,
                ));
            }

       

        $insertDB2 =  DB::table('tanks_has_pomps')->where('pomp_serial',$pompserialandtype[0])->where('tank_fuel_type',$pompserialandtype[1])->update(['last_approach'=>date('Y-m-d')]);


        if($insertDB && $insertDB2){
            $get_user_email = Auth::user()->email;
            $get_annex_id = DB::table('employees')->where('email',$get_user_email)->first()->annex_id;
            $getpomps = DB::select('SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE annex_id='.$get_annex_id.' AND last_approach !='."'$todaysdate'");
        if($getpomps != "[]"){
            return view('choose-pomp', ['pomps' => $getpomps,'success'=>'تم التسجيل بنجاح']); //sending tanks to user
        }else{
            die("<center><h1>سجل خزان اولا</h1></center>");
        }
        
        }else{
            die('حاول لاحقا');
        }
        }
    }
}