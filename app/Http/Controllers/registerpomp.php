<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class registerpomp extends Controller
{
    public function __construct()
    {
        $this->middleware('annex'); // restricting page for annexes only
    }

    public function get(){
        $userid = Auth::user()->email;
        $annex_id =  DB::table('annexes')->where('email',$userid)->first();
        $get_tanks = DB::table('tanks')->where('annex_id',$annex_id->idannexes)->get();
        $decodeddata = json_decode($get_tanks, true);
        return view('register-pomp', ['tanks' => $decodeddata]);
    }

    public function post(Request $request){
        $userid = Auth::user()->email;
        $annex_id =  DB::table('annexes')->where('email',$userid)->first();
        $get_tanks = DB::table('tanks')->where('annex_id',$annex_id->idannexes)->get();
        $decodeddata = json_decode($get_tanks, true);

        $validation = $request->validate([ //validating inputs
            'pompserial' => ['required','string'],
            'pomplastrecord' => ['required','string'],
            'tanknbr' => ['required','string'],
        ]);

        //setting vars

        $pompserial = $request->input('pompserial');
        $pomplastrecord = $request->input('pomplastrecord');
        $tanknbr = $request->input('tanknbr');

        $insertDB = DB::table('pomps')->insert( array ( //inserting into db
            'id' => null,
            'serial'=>$pompserial,
            'last record'=>$pomplastrecord,
            'tank_nbr'=>$tanknbr,
        ));

        if($insertDB){ //insert into db
            return view('register-pomp',['success' => 'تم تسجيل المظخة بنجاح'],['tanks' => $decodeddata]);
   }else{
       //else returning error
       return view('register-pomp',['failed' => 'لا يمكن تسجيل المظخة حاليا حاول لاحقا'],['tanks' => $decodeddata]);
   }
    }

}
