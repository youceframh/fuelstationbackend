<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Hash;
use App\User;

class registeremployee extends Controller
{

    public function __construct()
    {
        $this->middleware('company'); // restrcting this page to companies only
    }

    public function get(){
        //return annexes of that comp
        $company_id = Auth::user()->id;
        $annexes = DB::table('annexes')->where('companies_id',$company_id)->get();
        $decoded_data = json_decode($annexes,true);
        return view('register-employee',['annexes'=>$decoded_data]); // returning html of the page
    }

    public function post(Request $request){
        $company_id = Auth::user()->id;
        $annexes = DB::table('annexes')->where('companies_id',$company_id)->get();
        $decoded_data = json_decode($annexes,true);
        
        $verification =  $request->validate([ // verfication of fields
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string','min:8'],
            'nationalidcardnumber' => ['required', 'numeric', 'min:2'],
            'phone' => ['required', 'digits_between:6,15', 'min:8'],
            'adress' =>[ 'required', 'string', 'min:5'],
            'salary' => ['required','numeric'],
            'jobstartdate' => ['required','date'],
            'patrolstarttime' => ['required','date_format:H:i'],
            'patrolendtime' => ['required','date_format:H:i'],
            'patroltype' => ['required','string'],
            'possitioninannex' => ['required','string'],
            'annex' => ['required','string'],
            'closepersoname' => ['required','string'],
            'closepersonumber' => ['required','string'],
        ]);
        //if verification goes well 
           if($verification){
         
            $fullname = $request->input('fullname') ;
            $email = $request->input('email');
            $password = $request->input('email');
            $nationalidcardnumber = $request->input('nationalidcardnumber');
            $phone = $request->input('phone');
            $adress = $request->input('adress') ;
            $salary = $request->input('salary') ;
            $jobstartdate = $request->input('jobstartdate') ;
            $patrolstarttime = $request->input('patrolstarttime');
            $patrolendtime = $request->input('patrolendtime');
            $patroltype = $request->input('patroltype') ;
            $postioninannex = $request->input('possitioninannex') ;
            $annex = $request->input('annex');
            $closepersoname = $request->input('closepersoname') ;
            $closepersonumber = $request->input('closepersonumber') ;
             $company_id = Auth::user()->id; 
             //F5.iT/C57
            try{
                $userinsert =  User::create(array(
                    'name' => $fullname,
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'phone' => $request->input('phone'),
                    'picture' => null,
                    'is_admin' => false,
                    'typeofuser' => "annex_$postioninannex",
                ));

            }catch (\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                    return view('register-employee',['failed' => 'الايمايل المدخل مسجل حاليا'],['annexes'=>$decoded_data]);
                }
            }

            if($userinsert){
                $insertDB = DB::table('employees')->insert( array (
                    'id' => null,
                    'full name' => $fullname,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'national id card number' => $nationalidcardnumber,
                    'phone' => $phone,
                    'address' => $adress,
                    'salary' => $salary,
                    'job start date' => $jobstartdate,
                     'patrol_time_start' => $patrolstarttime,
                     'patrol_time_end' =>  $patrolendtime,	
                    'type of patrol' => $patroltype,
                    'position in annex'=> $postioninannex,
                        'annex_id' => $annex ,
                    'close person name' => $closepersoname,
                    'close person number' => $closepersonumber,
                    'worksincompanyid' => $company_id,
                ));
                //checking the status
                     if($insertDB){
                         return view('register-employee',['success' => 'تم تسجيل الموظف بنجاح'],['annexes'=>$decoded_data]);
                }else{
                    //else returning error
                    return view('register-employee',['failed' => 'لا يمكن تسجيل الموظف حاليا حاول لاحقا'].['annexes'=>$decoded_data]);
                }
            }
               
              
           }

    }
}

/*
  $fullname = $request->input('fullname') ;
               $email = $request->input('email');
               $password = $request->input('email');
               $nationalidcardnumber = $request->input('nationalidcardnumber');
               $phone = $request->input('phone');
               $adress = $request->input('adress') ;
               $salary = $request->input('salary') ;
               $jobstartdate = $request->input('jobstartdate') ;
               $patrolstarttime = $request->input('patrolstarttime');
               $patrolendtime = $request->input('patrolendtime');
               $patroltype = $request->input('patroltype') ;
               $postioninannex = $request->input('possitioninannex') ;
               $annex = $request->input('annex') ;
               $closepersoname = $request->input('closepersoname') ;
               $closepersonumber = $request->input('closepersonumber') ;
                $company_id = Auth::user()->id;

               //insert into db the infos 

               $insertDB = DB::table('employees')->insert( array (
                   'id' => null,
                   'email' => $email,
                   'password' => Hash::make($password),
                   'national id card number' => $nationalidcardnumber,
                   'phone' => $phone,
                   'address' => $adress,
                   'salary' => $salary,
                   'job start date' => $jobstartdate,
                    'patrol time start' => $patrolstarttime,
                    'patrol time end' =>  $patrolendtime,	
                   'type of patrol' => $patroltype,
                   'position in annex'=> $postioninannex,
                   	'annex_id' => $annex ,
                   'close person name' => $closepersoname,
                   'close person number' => $closepersonumber,
                   'worksincompanyid' => $company_id,
               ));
               //checking the status
                    if($insertDB){
                        return view('register-employee',['success' => 'تم تسجيل الموظف بنجاح']);
               }else{
                   //else returning error
                   return view('register-employee',['failed' => 'لا يمكن تسجيل الموظف حاليا حاول لاحقا']);
               }
 */