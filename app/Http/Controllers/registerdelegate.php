<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class registerdelegate extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(){
        $get_companies = DB::table('companies')->get();
        $decodeddata = json_decode($get_companies, true);
        return view('register-delegate', ['companies' => $decodeddata]);
    }

    public function post(Request $request){

        $get_companies = DB::table('companies')->get();
        $decodeddata = json_decode($get_companies, true);

        $validation = $request->validate([
            'name' => ['required','string'],
            'typeofjob' => ['required','string'],
            'phonenbr' => ['required','digits_between:8,15', 'min:8'],
            'company' => ['required','string'],
        ]);

        $name = $request->input('name');
        $type_of_job = $request->input('typeofjob');
        $phone = $request->input('phonenbr');
        $company_id = $request->input('company');

        $insertDB = DB::table('delegates')->insert( array (
            'id' => null,
            'name'=>$name,
            'type of job'=>$type_of_job,
            'phone'=>$phone,
            'company_id'=>$company_id,
        ));

        if($insertDB){
            return view('register-delegate',['success' => 'تم تسجيل المكلف بنجاح'],['companies' => $decodeddata]);
   }else{
       //else returning error
       return view('register-delegate',['failed' => 'لا يمكن تسجيل المكلف حاليا حاول لاحقا'],['companies' => $decodeddata]);
   }
    }

}
