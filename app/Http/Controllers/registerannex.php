<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class registerannex extends Controller
{
    public function __construct(){
        $this->middleware('company'); //checking if the company is eligible to add annexes through verification
    }

    public function get(){
        return view('register-annex'); //returning the html view of the page
    }
    
    public function post(Request $request){

        $rent_type = $request->input('renttype'); //switching for rent type cases

        switch($rent_type){ 
            case 'BUY' : //buying case
                $validation = $request->validate([ //validating all the inputs
                    'name' => ['required', 'string', 'max:255'],
                    'adress' => ['required', 'string', 'min:2'],
                    'country' => ['required', 'string', 'min:2'],
                    'city' => ['required', 'string', 'min:2'],
                    'phone' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'email'],
                    'password' => ['required', 'string','min:8'],
                    'renttype' => ['required', 'string'],
                ]);

                //adding inputs in variables so the work gets more structured
                $name = $request->input('name'); 
                $adress = $request->input('adress');
                $country = $request->input('country');
                $city = $request->input('city') ;
                $phone = $request->input('phone');
                $email = $request->input('email');
                $password = $request->input('password');
                $rent_type = $request->input('renttype') ;
                $company_id = Auth::user()->id;

                ///////////////////////////////////////
                try{
                    $userinsert =  User::create(array(
                        'name' =>  $name,
                        'email' => $request->input('email'),
                        'password' => Hash::make($request->input('password')),
                        'phone' => $request->input('phone'),
                        'picture' => null,
                        'is_admin' => false,
                        'typeofuser' => 'annex',
                    ));
    
                }catch (\Illuminate\Database\QueryException $e){
                    $errorCode = $e->errorInfo[1];
                    if($errorCode == 1062){
                        return view('register-annex',['failed' => 'الايمايل المدخل مسجل حاليا']);
                    }
                }
                   
                   if($userinsert){
    
                    $insertDB = DB::table('annexes')->insert( array ( //inserting infos into the table after verification
                        'idannexes' => null,
                        'name' => $name,
                        'address' => $adress,
                        'country' => $country ,
                        'city' => $city,
                        'phone' => $phone,
                        'email' => $email,
                        'rent type' => $rent_type, 
                        'rent start date' => null,
                        'rent end date' => null,
                        'price' => null,
                        'rentor name' => null,
                        'phone 2' => null,
                        'rent inovice number' => null,
                        'companies_id' => $company_id,
                    ));
    
                    if($insertDB){ //if insert is successful 
                        return view('register-annex',['success' => 'تم تسجيل الفرع بنجاح']);
               }else{
                   //else returning error
                   return view('register-annex',['failed' => 'لا يمكن تسجيل الفرع حاليا حاول لاحقا']);
               }
    
                   }else{
                    return view('register-annex',['failed' => 'لا يمكن تسجيل الفرع حاليا حاول لاحقا']);
                   }
    
                
            break;

            case 'RENT' : // in case of rent
                $validation = $request->validate([ //checking inputs
                    'name' => ['required', 'string', 'max:255'],
                    'adress' => ['required', 'string', 'min:2'],
                    'country' => ['required', 'string', 'min:2'],
                    'city' => ['required', 'string', 'min:2'],
                    'phone' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'email'],
                    'password' => ['required', 'string','min:8'],
                    'rentdatestart' => ['required','date'],
                    'rentdateend' => ['required','date'],
                    'price' => ['required', 'string'],
                    'rentorname' => ['required', 'string'],
                    'rentorphone' => ['required','digits_between:8,15', 'min:8'],
                    'rentinovicenbr' => ['required','numeric']
                ]);

                 //adding inputs in variables so the work gets more structured

                $name = $request->input('name');
                $adress = $request->input('adress');
                $country = $request->input('country');
                $city = $request->input('city') ;
                $phone = $request->input('phone');
                $email = $request->input('email');
                $password = $request->input('password');
                $rent_type = $request->input('renttype') ;
                $rent_date_start = $request->input('rentdatestart') ;
                $rent_date_end = $request->input('rentdateend') ;
                $price = $request->input('price') ;
                $rentor_name = $request->input('rentorname') ;
                $rentor_phone = $request->input('rentorphone') ;
                $rent_inovice_number = $request->input('rentinovicenbr') ;
                $company_id = Auth::user()->id;

                try{
                    $userinsert =  User::create(array(
                        'name' =>  $name,
                        'email' => $request->input('email'),
                        'password' => Hash::make($request->input('password')),
                        'phone' => $request->input('phone'),
                        'picture' => null,
                        'is_admin' => false,
                        'typeofuser' => 'annex',
                    ));
    
                }catch (\Illuminate\Database\QueryException $e){
                    $errorCode = $e->errorInfo[1];
                    if($errorCode == 1062){
                        return view('register-annex',['failed' => 'الايمايل المدخل مسجل حاليا']);
                    }
                }


                if($userinsert){

                $insertDB = DB::table('annexes')->insert( array ( //inserting infos into the table after verification
                    'idannexes' => null,
                    'name' => $name,
                    'address' => $adress,
                    'country' => $country ,
                    'city' => $city,
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

                if($insertDB){ //if insert is successful 
                    return view('register-annex',['success' => 'تم تسجيل الفرع بنجاح']);
           }else{
               //else returning error
               return view('register-annex',['failed' => 'لا يمكن تسجيل الفرع حاليا حاول لاحقا']);
           }
        }else{
            return view('register-annex',['failed' => 'لا يمكن تسجيل الفرع حاليا حاول لاحقا']);
        }
                break;
        }
    }
}
