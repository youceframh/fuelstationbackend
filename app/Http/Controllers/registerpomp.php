<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class registerpomp extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(){
        $annex_id = Auth::user()->id;
        $get_tanks = DB::table('tanks')->where('annex_id',$annex_id)->get();
        $decodeddata = json_decode($get_tanks, true);
        return view('register-pomp', ['tanks' => $decodeddata]);
    }

    public function post(Request $request){

        $annex_id = Auth::user()->id;
        $get_tanks = DB::table('tanks')->where('annex_id',$annex_id)->get();
        $decodeddata = json_decode($get_tanks, true);

        $validation = $request->validate([
            'pompserial' => ['required','string'],
            'pomplastrecord' => ['required','string'],
            'tanknbr' => ['required','string'],
        ]);

        $pompserial = $request->input('pompserial');
        $pomplastrecord = $request->input('pomplastrecord');
        $tanknbr = $request->input('tanknbr');

        $insertDB = DB::table('pomps')->insert( array (
            'id' => null,
            'serial'=>$pompserial,
            'last record'=>$pomplastrecord,
            'tank_nbr'=>$tanknbr,
        ));

        if($insertDB){
            return view('register-pomp',['success' => 'تم تسجيل الخزان بنجاح'],['tanks' => $decodeddata]);
   }else{
       //else returning error
       return view('register-pomp',['failed' => 'لا يمكن تسجيل الخزان حاليا حاول لاحقا'],['tanks' => $decodeddata]);
   }
    }

}
