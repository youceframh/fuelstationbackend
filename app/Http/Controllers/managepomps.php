<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB; 

class managepomps extends Controller
{
    public function __construct()
    {
        $this->middleware('teamleader'); 
    }

    public function get(){
        $team_leader_email = Auth::user()->email;
        $team_leader_annex = DB::table('employees')->where('email',$team_leader_email)->first()->annex_id;
        $team_leader_pomps = DB::table('pomps')->where('annex_id',$team_leader_annex)->get();
        $getpomps = DB::select('SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id='.$team_leader_annex.' AND annex_id='.$team_leader_annex.' AND `status`=1 ');
        if(isset($_GET['pompserial'])){
            $pompserialandtype = explode('&',$_GET['pompserial']);
            $checkPompSerial = preg_match("/^[a-zA-Z0-9]+$/", $pompserialandtype[0]);
            $checkPompFueltype = preg_match("/^[a-zA-Z0-9]+$/", $pompserialandtype[1]);
            if(!$checkPompSerial && !$checkPompFueltype){ //checkinf for sql injection
                die('<center><h1>الخزان الذي تبحث عنه غير موجود</h1></center>');
            }else{
                return view('managepomp',['pompserial'=>$pompserialandtype[0],'pomp_fuelType'=>$pompserialandtype[1]]);
            }

        }else{
            return view('choose-pomp',['pomps'=>$getpomps,'hide'=>true]);
        }
    }

    public function post(Request $request){
        $team_leader_email = Auth::user()->email;
        $team_leader_annex = DB::table('employees')->where('email',$team_leader_email)->first()->annex_id;
        $team_leader_pomps = DB::table('pomps')->where('annex_id',$team_leader_annex)->get();
        $getpomps = DB::select('SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id='.$team_leader_annex.' AND annex_id='.$team_leader_annex.'  AND `status`=1');
        if(isset($_POST['pompserial'])){
            $pompserialandtype = explode('&',$_POST['pompserial']);
            $checkPompSerial = preg_match("/^[a-zA-Z0-9]+$/", $pompserialandtype[0]);
            $checkPompFueltype = preg_match("/^[a-zA-Z0-9]+$/", $pompserialandtype[1]);
            if(!$checkPompSerial && !$checkPompFueltype){ //checkinf for sql injection
                die('<center><h1>الخزان الذي تبحث عنه غير موجود</h1></center>');
            }else{
                $getstatus = $request->input('status');
                $status;
                switch($getstatus){
                    case 'true':
                        $status = true;
                    break;
                    case 'false':
                        $status = false;
                    break;
                    default:
                        $status = true;
                    break;
                }

                $updateTHP = DB::table('tanks_has_pomps')->where('tank_annex_id',$team_leader_annex)->where('pomp_serial',$pompserialandtype[0])->where('tank_fuel_type',$pompserialandtype[1])->update([
                    'status' => $status
                ]);

                return view('choose-pomp',['pomps'=>$getpomps,'hide'=>true,'success'=>'تم التعديل بنجاح']);

            }

        }else{
            return view('choose-pomp',['pomps'=>$getpomps,'hide'=>true]);
        }
    }
    public function print(){
        $team_leader_email = Auth::user()->email;
        $team_leader_annex = DB::table('employees')->where('email',$team_leader_email)->first()->annex_id;
        $team_leader_pomps = DB::table('pomps')->where('annex_id',$team_leader_annex)->get();
        $getpomps = DB::select('SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id='.$team_leader_annex.' AND annex_id='.$team_leader_annex.' AND `status`=1');        

        if(isset($_GET['pompserial'])){
            $pompserialandtype = explode('&',$_GET['pompserial']);
            $checkPompSerial = preg_match("/^[a-zA-Z0-9]+$/", $pompserialandtype[0]);
            $checkPompFueltype = preg_match("/^[a-zA-Z0-9]+$/", $pompserialandtype[1]);
            if(!$checkPompSerial && !$checkPompFueltype){ //checkinf for sql injection
                die('<center><h1>الخزان الذي تبحث عنه غير موجود</h1></center>');
            }else{
                return view('printPomp',['pompserial'=>$pompserialandtype[0]]);
            }
    }else{
        return view('choose-pomp',['pomps'=>$getpomps,'hide2'=>true]);
    }
}
}
