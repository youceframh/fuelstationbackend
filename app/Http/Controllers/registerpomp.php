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
        $user_email = Auth::user()->email;
        $annex_id_d = DB::table('annexes')->where('email',$user_email)->first()->id;
        $validation = $request->validate([ //validating inputs
            'pompserial' => ['required','string'],
            'pomplastrecord' => ['required','string'],
            'tanknbr' => ['required'],
        ]);

        //setting vars

        $pompserial = $request->input('pompserial');
        $pomplastrecord = $request->input('pomplastrecord');
        $tanknbr = implode(',',$request->input('tanknbr'));
    
        $insertDB = DB::table('pomps')->insertGetId( array ( //inserting into db
            'id' => null,
            'serial'=>$pompserial,
            'last record'=>$pomplastrecord,
            'tank_nbr'=>$tanknbr,
            'annex_id' => $annex_id_d,
        ));

        foreach($request->input('tanknbr') as $tanks){
            $insertDB2 = DB::table('tanks_has_pomps')->insert(array(
                'id' => null,
                'tank_id' => $tanks,
                'pomp_id' => $insertDB,
                'last record' => $pomplastrecord
            ));
        }

       

        if($insertDB){ //insert into db
            return view('register-pomp',['success' => 'تم تسجيل المظخة بنجاح'],['tanks' => $decodeddata]);
   }else{
       //else returning error
       return view('register-pomp',['failed' => 'لا يمكن تسجيل المظخة حاليا حاول لاحقا'],['tanks' => $decodeddata]);
   }
    }

}
