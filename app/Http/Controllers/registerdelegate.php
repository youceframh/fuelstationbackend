<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Hash;
use App\User;

class registerdelegate extends Controller
{
    public function __construct()
    {
        $this->middleware('company'); //making only annex access this page
    }

    public function get(){
        return view('register-delegate'); //returning it to user
    }

    public function post(Request $request){

        $validation = $request->validate([ // validating inputs
            'name' => ['required','string'],
            'email' => ['required','email'],
            'password' => ['required','min:8'],
            'typeofjob' => ['required','string'],
            'phonenbr' => ['required','digits_between:8,15', 'min:8'],
        ]);

        //setting vars
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $type_of_job = $request->input('typeofjob');
        $phone = $request->input('phonenbr');
        $company_email_users = Auth::user()->email;
        $company_id = DB::table('companies')->where('email',$company_email_users)->first()->idcompanies;
            if($validation){
                try{
                   
                    $userinsert =  User::create(array(
                        'name' => $name,
                        'email' => $request->input('email'),
                        'password' => Hash::make($request->input('password')),
                        'phone' => $request->input('phonenbr'),
                        'picture' => null,
                        'is_admin' => false,
                        'typeofuser' => "delegate",
                    ));
        
                }catch (\Illuminate\Database\QueryException $e){
                    $errorCode = $e->errorInfo[1];
                    if($errorCode == 1062){
                        return view('register-delegate',['failed' => 'الايمايل المدخل مسجل حاليا']);
                    }
                }
        
                if(isset($userinsert)){
                    $insertDB = DB::table('delegates')->insert( array ( // inserting into db
                        'id' => null,
                        'name'=>$name,
                        'email'=>$email,
                        'type of job'=>$type_of_job,
                        'phone'=>$phone,
                        'company_id'=>$company_id,
                    ));
            
                    if($insertDB){//checking insert
                        return view('register-delegate',['success' => 'تم تسجيل المكلف بنجاح']);
               }else{
                   //else returning error
                   return view('register-delegate',['failed' => 'لا يمكن تسجيل المكلف حاليا حاول لاحقا']);
               }
                }else{
                    return view('register-delegate',['failed' => 'لا يمكن تسجيل المكلف حاليا حاول لاحقا']);
                }
        
            }
      
       
    }

}
