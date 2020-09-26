<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class registercompanies extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function get(){
        return view('register-companies');
    }

    public function post(Request $request){
        //verification of inputs and their types
      $verification =  $request->validate([
            'commercialname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'digits_between:6,15', 'min:8'],
            'country' => ['required', 'string', 'min:2'],
            'city' => ['required', 'string', 'min:2'],
            'state' => ['required', 'string', 'min:2'],
            'zip' => ['required', 'digits_between:2,8', 'min:3'],
            'language' => ['required', 'string', 'min:2'],
            'taxnumber' => ['required', 'digits_between:1,255', 'min:3'],
            'commercialnumber' => ['required', 'digits_between:1,255', 'min:3'],
            'adress1' =>[ 'required', 'string', 'min:5'],
            'adress2' => ['required', 'string', 'min:3'],
            'logo' => ['required','image','max:3072'],
        ]);
        //if verification goes well 
           if($verification){
               //make inputs inside vars
               $commercial_name = $request->input('commercialname');
               $first_name =$request->input('firstname') ;
               $last_name =$request->input('lastname') ;
               $phone = $request->input('phone');
               $country = $request->input('country');
               $city = $request->input('city') ;
               $state = $request->input('state');
               $zip = $request->input('zip');
               $tax_number = $request->input('taxnumber') ;
               $language = $request->input('language') ;
               $commercial_number = $request->input('commercialnumber');
               $adress_1 =$request->input('adress1') ;
               $adress_2 = $request->input('adress2');
               $logo = $request->logo;

               //insert into db the infos 

               $insertDB = DB::table('companies')->insert( array (
                   'idcompanies' => null,
                   'commercial name' => $commercial_name,
                   'first name' => $first_name,
                   'last name' => $last_name,
                   'phone' => $phone,
                   'country' => $country,
                   'city' => $city,
                   'state' => $state ,
                   'zip' => $zip,
                   'tax number' => $tax_number,
                   'language' => $language,
                   'commercial number' => $commercial_number,
                   'address 1' => $adress_1,
                   'address 2' => $adress_2,
                   'logo' => $logo, 
                   'role' => '1',  
               ));
               //checking the status
                    if($insertDB){
                        return view('register-companies',['success' => 'تم تسجيل الشركة بنجاح']);
               }else{
                   //else returning error
                   return view('register-companies',['failed' => 'لا يمكن تسجيل الشركة حاليا حاول لاحقا']);
               }
           }

    }
}
