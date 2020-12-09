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
        return view('register-pomp', ['tanks' => $get_tanks]);
    }

    public function post(Request $request){

        $userid = Auth::user()->email;
        $annex_id =  DB::table('annexes')->where('email',$userid)->first();
        $get_tanks = DB::table('tanks')->where('annex_id',$annex_id->idannexes)->get();
        $decodeddata = json_decode($get_tanks, true);
        $user_email = Auth::user()->email;
        $annex_id_d = DB::table('annexes')->where('email',$user_email)->first()->idannexes;
        $validation = $request->validate([ //validating inputs
            'pompserial' => ['required','string'],
            'pomplastrecord' => ['required','string'],
            'tanknbr' => ['required'],
        ]);

        //setting vars

        $pompserial = $request->input('pompserial');
        $pomplastrecord = $request->input('pomplastrecord');
        $tanknbr = implode(',',$request->input('tanknbr'));

        $checkifpompserialalreadyexists = DB::table('pomps')->where('serial',$pompserial)->exists();

        if(!$checkifpompserialalreadyexists){
            $insertDB = DB::table('pomps')->insertGetId( array ( //inserting into db
                'id' => null,
                'serial'=> strtoupper($pompserial),
                'last_record'=>$pomplastrecord,
                'tank_nbr'=>$tanknbr,
                'annex_id' => $annex_id_d,
            ));
    
            foreach($request->input('tanknbr') as $tanks){
                $tank_fuel_type = DB::table('tanks')->where('tank_number',$tanks)->first()->fuel_type;
                $insertDB2 = DB::table('tanks_has_pomps')->insert(array(
                    'id' => null,
                    'tank_annex_id' =>$annex_id_d,
                    'tank_id' => $tanks,
                    'pomp_id' => $insertDB,
                    'pomp_serial' => strtoupper($pompserial),
                    'last_record' => $pomplastrecord,
                    'tank_fuel_type' =>$tank_fuel_type,
    
                ));
            }
    
           
    
            if($insertDB){ //insert into db
                return view('register-pomp',['success' => 'تم تسجيل المظخة بنجاح'],['tanks' => $get_tanks]);
       }else{
           //else returning error
           return view('register-pomp',['failed' => 'لا يمكن تسجيل المظخة حاليا حاول لاحقا'],['tanks' => $get_tanks]);
       }
        }else{
            return view('register-pomp',['failed' => 'من فضلك ادخل رقم مظخة مختلف'],['tanks' => $get_tanks]);
        }
    

    }

}
