<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class fuelprices extends Controller
{
    public function __construct()
    {
        $this->middleware('company'); 
    }

    public function get(){
        return view('fuel-prices');
    }

    public function post(Request $request){
        $request->validate([
            'newprice' => ['required','between:0,9999.99'],
            'fueltype' => ['required','string']
        ]);

        $get_fuel_type = $request->input('fueltype');
        $get_fuel_price = $request->input('newprice');
       

        switch($get_fuel_type){
            case 'gasoline':
                $dbQ = DB::table('fuel_price')->where('fuel_type','gasoline')->update(['price'=>$get_fuel_price]);
                return view('fuel-prices',['success'=>'تم تغيير الثمن بنجاح']);
            break;
            case 'diesel':
                $dbQ = DB::table('fuel_price')->where('fuel_type','diesel')->update(['price'=>$get_fuel_price]);
                return view('fuel-prices',['success'=>'تم تغيير الثمن بنجاح']);
            break;
            case 'essence91':
                $dbQ = DB::table('fuel_price')->where('fuel_type','essence91')->update(['price'=>$get_fuel_price]);
                return view('fuel-prices',['success'=>'تم تغيير الثمن بنجاح']);
            break;
            case 'essence95':
                $dbQ = DB::table('fuel_price')->where('fuel_type','essence95')->update(['price'=>$get_fuel_price]);
                 return view('fuel-prices',['success'=>'تم تغيير الثمن بنجاح']);
            break;
            default:
                return view('fuel-prices',['failed'=>'اعد تحديد نوع البترول']);
            break;
        }
    }
}
