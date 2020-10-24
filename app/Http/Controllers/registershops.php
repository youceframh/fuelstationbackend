<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;   

class registershops extends Controller
{
    public function __construct(){
        $this->middleware('annex'); //using the company middleware in order to make this page only accessible for companies
    }

    public function get(){
        return view('register-shop'); // returning html page
    }

    public function post(Request $request){
        $validation = $request->validate([ // validating columns
            'shopnbr' => ['required', 'numeric'],
            'shopsurface' => ['required','string'],
            'shoptype' => ['required', 'string'],
            'shopprice' => ['required', 'string'],
        ]);

            //setting inputs vars
        $shopnbr = $request->input('shopnbr');
        $shopsurface = $request->input('shopsurface');
        $shoptype = $request->input('shoptype');
        $shopprice = $request->input('shopprice') ;
        $annex_id = Auth::user()->id;

        $insertDB = DB::table('shops')->insert( array ( // inserting infos into db
            'idshops' => null,
            'number' => $shopnbr,
            'surface' => $shopsurface,
            'type' => $shoptype ,
            'price' => $shopprice,
            'under annex id' => $annex_id,
        ));

        if($insertDB){ //returning success message
            return view('register-shop',['success' => 'تم تسجيل المحل بنجاح']);
   }else{
       //else returning error
       return view('register-shop',['failed' => 'لا يمكن تسجيل المحل حاليا حاول لاحقا']);
   }
    }
}
