<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class registerdelegate extends Controller
{
    public function __construct()
    {
        $this->middleware('annex'); //making only annex access this page
    }

    public function get(){
        $annexemail = Auth::user()->email; //getting annex email
        $annexcompanyidinusers = DB::table('annexes')->where('email',$annexemail)->first(); // finding annex row in its table
        $getuserinfos =  DB::table('users')->where('id',$annexcompanyidinusers->companies_id)->first(); // getting annex company row in users 
        $get_companies = DB::table('companies')->where('email',$getuserinfos->email)->get(); // searching for companies infos in its table by users table infos
        $decodeddata = json_decode($get_companies, true); // decoding data
        return view('register-delegate', ['companies' => $decodeddata]); //returning it to user
    }

    public function post(Request $request){

        $annexemail = Auth::user()->email; //getting annex email
        $annexcompanyidinusers = DB::table('annexes')->where('email',$annexemail)->first(); // finding annex row in its table
        $getuserinfos =  DB::table('users')->where('id',$annexcompanyidinusers->companies_id)->first(); // getting annex company row in users 
        $get_companies = DB::table('companies')->where('email',$getuserinfos->email)->get(); // searching for companies infos in its table by users table infos
        $decodeddata = json_decode($get_companies, true); // decoding data

        $validation = $request->validate([ // validating inputs
            'name' => ['required','string'],
            'typeofjob' => ['required','string'],
            'phonenbr' => ['required','digits_between:8,15', 'min:8'],
            'company' => ['required','string'],
        ]);

        //setting vars
        $name = $request->input('name');
        $type_of_job = $request->input('typeofjob');
        $phone = $request->input('phonenbr');
        $company_id = $request->input('company');

        $insertDB = DB::table('delegates')->insert( array ( // inserting into db
            'id' => null,
            'name'=>$name,
            'type of job'=>$type_of_job,
            'phone'=>$phone,
            'company_id'=>$company_id,
        ));

        if($insertDB){//checking insert
            return view('register-delegate',['success' => 'تم تسجيل المكلف بنجاح'],['companies' => $decodeddata]);
   }else{
       //else returning error
       return view('register-delegate',['failed' => 'لا يمكن تسجيل المكلف حاليا حاول لاحقا'],['companies' => $decodeddata]);
   }
    }

}
