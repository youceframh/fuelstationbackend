<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class companyreport extends Controller
{
    public function __construct(){
        $this->middleware('company');
    } 

    public function get(){
        return view('company-send-report');
    }

    public function post(Request $request){
        $getuseremail =  Auth::user()->email;
        $getCompID= DB::table('users')->where('email',$getuseremail)->first()->id;
  
          $validation = $request->validate([
              'reporttype' => ['required','string'],
              'report' => ['required','string'],
              'datePicker' => ['nullable','date'],
          ]);
  
          $typeofreport = $request->input('reporttype');
          $message = $request->input('report');
          $reportdate = date('Y-m-d');
        
          if($validation){
              $insertDB = DB::table('report_from_company')->insert(array(
                  'id' => null,
                  'comp_id' => $getCompID,
                  'date' => $reportdate,
                  'message' => $message,
                  'report_type' => $typeofreport
              ));

              if($insertDB){
                return view('company-send-report',['success' => 'لقد تم اعلام الفروع']);
       }else{
           //else returning error
           return view('company-send-report',['failed' => 'لا يمكن التسجيل حاليا حاول لاحقا']);
       }

          }
    }
}
