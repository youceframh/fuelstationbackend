<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;   

class registershops extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function get(){
        return view('register-shop');
    }

    public function post(Request $request){
        $validation = $request->validate([
            'shopnbr' => ['required', 'numeric'],
            'shopsurface' => ['required','string'],
            'shoptype' => ['required', 'string'],
            'shopprice' => ['required', 'string'],
        ]);

        $shopnbr = $request->input('shopnbr');
        $shopsurface = $request->input('shopsurface');
        $shoptype = $request->input('shoptype');
        $shopprice = $request->input('shopprice') ;
        $annex_id = Auth::user()->id;

        $insertDB = DB::table('shops')->insert( array (
            'idshops' => null,
            'number' => $shopnbr,
            'surface' => $shopsurface,
            'type' => $shoptype ,
            'price' => $shopprice,
            'under annex id' => $annex_id,
        ));

        if($insertDB){
            return view('register-shop',['success' => 'تم تسجيل المحل بنجاح']);
   }else{
       //else returning error
       return view('register-shop',['failed' => 'لا يمكن تسجيل المحل حاليا حاول لاحقا']);
   }
    }
}
