<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class confirmpatrol extends Controller
{
    public function __construct()
    {
        $this->middleware('delegate');
    }

    public function get(){
        if(isset($_GET['searchquery'])){ //search by patrol dailyid
            if(preg_match("/^[a-zA-Z0-9 ]+$/", $_GET['searchquery'])){
                $get_all_unconfirmed_patrols = DB::table('daily')->where('confirmed','0')->where('code',$_GET['searchquery'])->get();
                return view('show-unconfirmed-patrols',['patrols'=>$get_all_unconfirmed_patrols]);
            } else {
                $get_all_unconfirmed_patrols = DB::table('daily')->where('confirmed','0')->get();
                return view('show-unconfirmed-patrols',['patrols'=>$get_all_unconfirmed_patrols]);
            }
        }elseif(isset($_GET['patrol'])){
            $get_all_unconfirmed_patrols = DB::table('daily')->where('confirmed','0')->get();
            if(preg_match("/^[0-9 ]+$/", $_GET['patrol'])){return view('confirm-patrol',['patrolid'=>$_GET['patrol']]);}else{  return view('show-unconfirmed-patrols',['patrols'=>$get_all_unconfirmed_patrols]);}
            
        }else{ //show all unconfirmed patrols
            $get_all_unconfirmed_patrols = DB::table('daily')->where('confirmed','0')->get();
            return view('show-unconfirmed-patrols',['patrols'=>$get_all_unconfirmed_patrols]);
        }
    }


    public function post(Request $request){

   if(isset($_GET['patrol'])){
        if(preg_match("/^[0-9]+$/", $_GET['patrol'])){
            $validation = $request->validate([
                'patrol'=>['required','string'],
                'moneyplace'=>['required','string'],
                'totalofmoney'=>['required','string'],
                'restofmoney'=>['string'],
                'receiptnumber'=>['nullable'],
                'receiptnumberofbank'=>['nullable'],
            ]);

            $patrol_id = $request->input('patrol');
            $patrol_code = DB::table('daily')->where('iddaily',$patrol_id)->first()->code;
            $patrol_iddaily =  DB::table('daily')->where('iddaily',$patrol_id)->first()->iddaily;
            $moneyplace = $request->input('moneyplace');
            $totalofmoney = $request->input('totalofmoney');
            $restofmoney = $request->input('restofmoney');
            $receiptnumber = $request->input('receiptnumber');
             $receiptnumberofbank = $request->input('receiptnumberofbank');
             $impotence = $request->input('impotence');
             $total_cash = $request->input('totalnet');
             $notes = $request->input('notes');

            $insertDB = DB::table('safe')->insert(array(
                'id'=> null,
                'patrol_code'=>$patrol_code,
                'money_place'=>$moneyplace,
                'total_cash'=>$totalofmoney,
                'rest_cash'=> $restofmoney,
                'innovice_nbr'=> $receiptnumber,
            ));

            $insertDBupdate = DB::table('daily')->where('code',$patrol_code)->update([
                'confirmed' =>true,
            ]);

            $insertDBupdatepatrolsumm = DB::table('patrol_summ')->where('iddaily',$patrol_iddaily)->update([
                'impotence' => $impotence,
            'notes' => $notes,
            'total' => $total_cash,
            ]);

            return redirect('/patrol/confirm');
        }else{  
            return view('show-unconfirmed-patrols',['patrols'=>$get_all_unconfirmed_patrols]);
        }
        
    }
}

}
