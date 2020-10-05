<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class maintenance extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(){
        
        $get_tanks = DB::table('tanks')->where('annex_id',Auth::user()->id)->get();
        if($get_tanks != "[]"){
            foreach($get_tanks as $tank){
                $get_pomps = DB::table('pomps')->where('tank_nbr',$tank->id_tank)->get();
            }
    
            $decodeddata = json_decode($get_pomps, true);
            return view('maintenance', ['pomps' => $decodeddata]);
        }else{
            die("<center><h1>سجل خزان اولا</h1></center>");
        }
        
    }
    public function post(Request $request){

        $get_tanks = DB::table('tanks')->where('annex_id',Auth::user()->id)->get();
        if($get_tanks != "[]"){

            $validation = $request->validate([
                'pomp' => ['required'],
                'date' => ['required','date'],
                'notes' => ['required','string'],
            ]);
    
            $pomp = $request->input('pomp');
            $date = $request->input('date');
            $notes = $request->input('notes');
    
            $insertDB = DB::table('maintenance')->insert( array (
                'id' => null,
                'pomp changed prices'=>$pomp,
                'date'=>$date,
                'notes'=>$notes,
            ));
    
            if($insertDB){
                foreach($get_tanks as $tank){
                    $get_pomps = DB::table('pomps')->where('tank_nbr',$tank->id_tank)->get();
                }
        
                $decodeddata = json_decode($get_pomps, true);
                return view('maintenance', ['pomps' => $decodeddata],['success' => 'تم تسجيل بنجاح']);
       }else{
           //else returning error
           return view('maintenance', ['pomps' => $decodeddata],['success' => 'لا يمكن التسجيل حاليا حاول لاحقا']);
       }

        }else{
            die("<center><h1>سجل خزان اولا</h1></center>");
        }
    }
}
