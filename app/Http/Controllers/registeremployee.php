<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

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
        $verification =  $request->validate([ // verfication of fields
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string','min:8'],
            'nationalidcardnumber' => ['required', 'numeric', 'min:2'],
            'phone' => ['required', 'digits_between:6,15', 'min:8'],
            'adress' =>[ 'required', 'string', 'min:5'],
            'salary' => ['required','numeric'],
            'jobstartdate' => ['required','date'],
            'patrolstarttime' => ['required','time'],
            'patrolendtime' => ['required','time'],
            'patroltype' => ['required','string'],
            'possitioninannex' => ['required','string'],
            'annex' => ['required','string'],
            'closepersoname' => ['required','string'],
            'closepersonumber' => ['required','string'],
        ]);
        //if verification goes well 
           if($verification){
               //make inputs inside vars

               //adding email,password, patrol time start , patrol time end,position in annex, annex_id in db and here
               // register in users and in type we write annex

               $fullname = $request->input('fullname') ;
               $nationalidcardnumber = $request->input('nationalidcardnumber');
               $phone = $request->input('phone');
               $adress = $request->input('adress') ;
               $salary = $request->input('salary') ;
               $jobstartdate = $request->input('jobstartdate') ;
               $patroltype = $request->input('patroltype') ;
               $closepersoname = $request->input('closepersoname') ;
               $closepersonumber = $request->input('closepersonumber') ;
                $company_id = Auth::user()->id;

               //insert into db the infos 

               $insertDB = DB::table('employees')->insert( array (
                   'id' => null,
                   'full name' => $fullname,
                   'national id card number' => $nationalidcardnumber,
                   'phone' => $phone,
                   'address' => $adress,
                   'salary' => $salary,
                   'job start date' => $jobstartdate,
                   'type of patrol' => $patroltype ,
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
           }

    }
}
