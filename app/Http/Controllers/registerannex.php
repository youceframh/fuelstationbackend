<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class registerannex extends Controller
{
    public function __construct(){
        $this->middleware('company.status');
    }

    public function get(){
        return view('register-annex');
    }
    
    public function post(Request $request){

        $rent_type = $request->input('renttype');
        switch($rent_type){
            case 'BUY' : 
                $validation = $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'adress' => ['required', 'string', 'min:2'],
                    'country' => ['required', 'string', 'min:2'],
                    'city' => ['required', 'string', 'min:2'],
                    'phone' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'email'],
                    'renttype' => ['required', 'string'],
                ]);

                $name = $request->input('name');
                $adress = $request->input('adress');
                $country = $request->input('country');
                $city = $request->input('city') ;
                $phone = $request->input('phone');
                $email = $request->input('email');
                $rent_type = $request->input('renttype') ;
                $company_id = Auth::user()->id;

                $insertDB = DB::table('annexes')->insert( array (
                    'idannexes' => null,
                    'name' => $name,
                    'address' => $adress,
                    'country' => $country ,
                    'city' => $city,
                    'email' => $email,
                    'phone' => $phone,
                    'email' => $email,
                    'rent type' => $rent_type, 
                    'rent start date' => null,
                    'rent end date' => null,
                    'price' => null,
                    'rentor name' => null,
                    'phone 2' => null,
                    'rent inovice number' => null,
                    'rent inovice number' => null ,
                    'companies_id' => $company_id,
                ));

                if($insertDB){
                    return view('register-annex',['success' => 'تم تسجيل الفرع بنجاح']);
           }else{
               //else returning error
               return view('register-annex',['failed' => 'لا يمكن تسجيل الفرع حاليا حاول لاحقا']);
           }
                
            break;

            case 'RENT' :
                $validation = $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'adress' => ['required', 'string', 'min:2'],
                    'country' => ['required', 'string', 'min:2'],
                    'city' => ['required', 'string', 'min:2'],
                    'phone' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'email'],
                    'rentdatestart' => ['required','date'],
                    'rentdateend' => ['required','date'],
                    'price' => ['required', 'string'],
                    'rentorname' => ['required', 'string'],
                    'rentorphone' => ['required','digits_between:8,15', 'min:8'],
                    'rentinovicenbr' => ['required','numeric']
                ]);

                $name = $request->input('name');
                $adress = $request->input('adress');
                $country = $request->input('country');
                $city = $request->input('city') ;
                $phone = $request->input('phone');
                $email = $request->input('email');
                $rent_type = $request->input('renttype') ;
                $rent_date_start = $request->input('rentdatestart') ;
                $rent_date_end = $request->input('rentdateend') ;
                $price = $request->input('price') ;
                $rentor_name = $request->input('rentorname') ;
                $rentor_phone = $request->input('rentorphone') ;
                $rent_inovice_number = $request->input('rentinovicenbr') ;
                $company_id = Auth::user()->id;

                $insertDB = DB::table('annexes')->insert( array (
                    'idannexes' => null,
                    'name' => $name,
                    'address' => $adress,
                    'country' => $country ,
                    'city' => $city,
                    'email' => $email,
                    'phone' => $phone,
                    'email' => $email,
                    'rent type' => $rent_type, 
                    'rent start date' => $rent_date_start,
                    'rent end date' => $rent_date_end,
                    'price' => $price,
                    'rentor name' => $rentor_name,
                    'phone 2' => $rentor_phone,
                    'rent inovice number' => $rent_inovice_number,
                    'companies_id' => $company_id,
                ));

                if($insertDB){
                    return view('register-annex',['success' => 'تم تسجيل الفرع بنجاح']);
           }else{
               //else returning error
               return view('register-annex',['failed' => 'لا يمكن تسجيل الفرع حاليا حاول لاحقا']);
           }
                break;
        }
    }
}
