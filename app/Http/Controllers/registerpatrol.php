<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class registerpatrol extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(){
       
        if(isset($_GET['pompserial'])){

            if(!preg_match("/^[a-zA-Z0-9]+$/", $_GET['pompserial'])){
                die('<center><h1>الخزان الذي تبحث عنه غير موجود</h1></center>');
            }else{
                $pomp_serial = $_GET['pompserial'];

                $get_tanks = DB::table('tanks')->where('annex_id',Auth::user()->id)->get();
    
                if(DB::table('pomps')->where('serial', $pomp_serial)->get() != "[]" ){
                    foreach($get_tanks as $tank){
                        $get_pomp = DB::table('pomps')->where('serial', $pomp_serial)->get();
                    }
        
                    $decodeddata = json_decode($get_pomp, true);
        
                    return view('register-patrol',['pomp_serial' => $decodeddata]);
               
                }else{
                    die('<center><h1>الخزان الذي تبحث عنه غير موجود</h1></center>');
                }
    
            }

            
            
        
        }else{

            $get_tanks = DB::table('tanks')->where('annex_id',Auth::user()->id)->get();
        if($get_tanks != "[]"){
            foreach($get_tanks as $tank){
                $get_pomps = DB::table('pomps')->where('tank_nbr',$tank->id_tank)->get();
            }
    
            $decodeddata = json_decode($get_pomps, true);
            return view('choose-pomp', ['pomps' => $decodeddata]);
        }else{
            die("<center><h1>سجل خزان اولا</h1></center>");
        }
        
    }
}
    public function post(Request $request){
        $validate = $request->validate([
            'lastrecord' => ['required','numeric'],
            'newrecord' => ['required','numeric'],
            'paymenttype' => ['required','string'],
            'total' => ['required','string'],
            'canberegistredby' => ['required','string']
        ]);

        $pomp_nbr = $_POST['pomp'];
        $last_record = $request->input('lastrecord');
        $new_record = $request->input('newrecord');
        $payment_type = $request->input('paymenttype');
        $total = $request->input('total');
        $can_be_registred_by = $request->input('canberegistredby');

        $insertDB = DB::table('patrol')->insert( array (
            'date' => date('Y-m-d'),
            'pomp nbr'=>$pomp_nbr,
            'last record'=>$last_record,
            'new record'=>$new_record,
            'type of cash'=>$payment_type,
            'total'=>$total,
            'can be added by'=>$can_be_registred_by,
        ));

        $insertDB2 = DB::table('pomps')->where('serial',$pomp_nbr)->update(['last record'=> $new_record]);

        if($insertDB && $insertDB2){
            if(isset($_GET['pompserial'])){

                if(!preg_match("/^[a-zA-Z0-9]+$/", $_GET['pompserial'])){
                    die('<center><h1>الخزان الذي تبحث عنه غير موجود</h1></center>');
                }else{
                    $pomp_serial = $_GET['pompserial'];
    
                    $get_tanks = DB::table('tanks')->where('annex_id',Auth::user()->id)->get();
        
                    if(DB::table('pomps')->where('serial', $pomp_serial)->get() != "[]" ){
                        foreach($get_tanks as $tank){
                            $get_pomp = DB::table('pomps')->where('serial', $pomp_serial)->get();
                        }
            
                        $decodeddata = json_decode($get_pomp, true);
            
                        return view('register-patrol',['pomp_serial' => $decodeddata],['success' => 'تم التسجيل بنجاح']);
                   
                    }else{
                        die('<center><h1>الخزان الذي تبحث عنه غير موجود</h1></center>');
                    }
        
                }
    
                
                
            
            }else{
    
                $get_tanks = DB::table('tanks')->where('annex_id',Auth::user()->id)->get();
            if($get_tanks != "[]"){
                foreach($get_tanks as $tank){
                    $get_pomps = DB::table('pomps')->where('tank_nbr',$tank->id_tank)->get();
                }
        
                $decodeddata = json_decode($get_pomps, true);
                return view('choose-pomp', ['pomps' => $decodeddata],['success' => 'تم التسجيل بنجاح']);
            }else{
                die("<center><h1>سجل خزان اولا</h1></center>");
            }
            
        }
   }else{
    if(isset($_GET['pompserial'])){

        if(!preg_match("/^[a-zA-Z0-9]+$/", $_GET['pompserial'])){
            die('<center><h1>الخزان الذي تبحث عنه غير موجود</h1></center>');
        }else{
            $pomp_serial = $_GET['pompserial'];

            $get_tanks = DB::table('tanks')->where('annex_id',Auth::user()->id)->get();

            if(DB::table('pomps')->where('serial', $pomp_serial)->get() != "[]" ){
                foreach($get_tanks as $tank){
                    $get_pomp = DB::table('pomps')->where('serial', $pomp_serial)->get();
                }
    
                $decodeddata = json_decode($get_pomp, true);
    
                return view('register-patrol',['pomp_serial' => $decodeddata],['success' => 'لا يمكن التسجيل حاليا حاول لاحقا']);
           
            }else{
                die('<center><h1>الخزان الذي تبحث عنه غير موجود</h1></center>');
            }

        }

        
        
    
    }else{

        $get_tanks = DB::table('tanks')->where('annex_id',Auth::user()->id)->get();
    if($get_tanks != "[]"){
        foreach($get_tanks as $tank){
            $get_pomps = DB::table('pomps')->where('tank_nbr',$tank->id_tank)->get();
        }

        $decodeddata = json_decode($get_pomps, true);
        return view('choose-pomp', ['pomps' => $decodeddata],['success' => 'لا يمكن التسجيل حاليا حاول لاحقا']);
    }else{
        die("<center><h1>سجل خزان اولا</h1></center>");
    }
    
}
   }

    }
}

// check if pomp serial already exits
// Maintenenance