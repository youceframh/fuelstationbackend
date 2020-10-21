<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class registertank extends Controller
{
    public function __construct()
    {
        $this->middleware('annex'); // restricting this page for annex users only
    }

    public function get(){
        $annex_email = Auth::user()->email; // getting email of annex user 
        $get_annexes = DB::table('annexes')->where('email',$annex_email)->get(); //returning available annexes
        return view('register-tank', ['annexes' => $get_annexes]); //sending html to user
    }

    public function post(Request $request){
        $annex_email = Auth::user()->email; // getting email of annex user 
        $get_annexes = DB::table('annexes')->where('email',$annex_email)->get(); //returning available annexes
        
        $validation = $request->validate([ //validating inputs
            'tanknbr' => ['required','string'],
            'volumeoftank' => ['required','string'],
            'fueltype' => ['required','string'],
            'reliedtoannex' => ['required','numeric'],
        ]);
            //setting vars
        $tank_number = $request->input('tanknbr');
        $tank_volume = $request->input('volumeoftank');
        $fuel_type = $request->input('fueltype');
        $related_to_annex = $request->input('reliedtoannex');

        $insertDB = DB::table('tanks')->insert( array ( //inserting into db
            'id_tank' => null,
            'tank number'=>$tank_number,
            'tank volume'=>$tank_volume,
            'fuel type'=>$fuel_type,
            'annex_id'=>$related_to_annex,
        ));

        if($insertDB){ //retruning infos of insert process
            return view('register-tank',['success' => 'تم تسجيل الخزان بنجاح'],['annexes' => $get_annexes]);
   }else{
       //else returning error
       return view('register-tank',['failed' => 'لا يمكن تسجيل الخزان حاليا حاول لاحقا'],['annexes' => $get_annexes]);
   }
    }
}
