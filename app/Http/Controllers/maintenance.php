<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class maintenance extends Controller
{
    public function __construct()
    {
        $this->middleware('annex'); //restricting this page to comapny only
    }

    public function get(){
        $get_annex_email = DB::table('annexes')->where('email',Auth::user()->email)->first(); //getting annex email
        $get_tanks = DB::table('tanks')->where('annex_id',$get_annex_email->idannexes)->get(); //getting tanks
        if($get_tanks != "[]"){ //getting tanks and looping the
            foreach($get_tanks as $tank){
                $get_pomps = DB::table('pomps')->where('tank_nbr',$tank->id_tank)->get();
            }
    
            $decodeddata = json_decode($get_pomps, true);
            return view('maintenance', ['pomps' => $decodeddata]); //sending tanks to user
        }else{
            die("<center><h1>سجل خزان اولا</h1></center>");
        }
        
    }
    public function post(Request $request){

        $get_annex_email = DB::table('annexes')->where('email',Auth::user()->email)->first(); //getting annex email
        $get_tanks = DB::table('tanks')->where('annex_id',$get_annex_email->idannexes)->get(); //getting tanks

        if($get_tanks != "[]"){

            $validation = $request->validate([ //validating inputs
                'pomp' => ['required'],
                'date' => ['required','date'],
                'notes' => ['required','string'],
            ]);
    //SETTING VARS
            $pomp = $request->input('pomp');
            $date = $request->input('date');
            $notes = $request->input('notes');
    
            $insertDB = DB::table('maintenance')->insert( array (//inserting into db
                'id' => null,
                'pomp changed prices'=>$pomp,
                'date'=>$date,
                'notes'=>$notes,
            ));
    
            if($insertDB){//returning insert infos and returning tanks
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
