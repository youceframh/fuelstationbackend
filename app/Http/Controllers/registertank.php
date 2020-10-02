<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class registertank extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(){
        $company_id = Auth::user()->id;
        $get_annexes = DB::table('annexes')->where('companies_id',$company_id)->get();
        return view('register-tank', ['annexes' => $get_annexes]);
    }

    public function post(Request $request){
        $company_id = Auth::user()->id;
        $get_annexes = DB::table('annexes')->where('companies_id',$company_id)->get();
        
        $validation = $request->validate([
            'tanknbr' => ['required','string'],
            'volumeoftank' => ['required','string'],
            'fueltype' => ['required','string'],
            'reliedtoannex' => ['required','numeric'],
        ]);

        $tank_number = $request->input('tanknbr');
        $tank_volume = $request->input('volumeoftank');
        $fuel_type = $request->input('fueltype');
        $related_to_annex = $request->input('reliedtoannex');

        $insertDB = DB::table('tanks')->insert( array (
            'id_tank' => null,
            'tank number'=>$tank_number,
            'tank volume'=>$tank_volume,
            'fuel type'=>$fuel_type,
            'annex_id'=>$related_to_annex,
        ));

        if($insertDB){
            return view('register-tank',['success' => 'تم تسجيل الخزان بنجاح'],['annexes' => $get_annexes]);
   }else{
       //else returning error
       return view('register-tank',['failed' => 'لا يمكن تسجيل الخزان حاليا حاول لاحقا'],['annexes' => $get_annexes]);
   }
    }
}
