<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class sendreport extends Controller
{
    public function __construct()
    {
        $this->middleware('teamleaderNotime');
    }

    public function get(){
        return view('sendreport');
    }

    public function post(Request $request){
      $getuseremail =  Auth::user()->email;
      $getusercomp_id = DB::table('employees')->where('email',$getuseremail)->first()->worksincompanyid;
      $getannex_id = DB::table('employees')->where('email',$getuseremail)->first()->annex_id;

        $validation = $request->validate([
            'reporttype' => ['required','string'],
            'report' => ['required','string'],
            'datePicker' => ['nullable','date'],
            'to' => ['string','required'],
            'getannex_name' => ['string','required']
        ]);

        $typeofreport = $request->input('reporttype');
        $message = $request->input('report');
        $reportnbr = $request->input('reportnbr');
        $to = $request->input('to');
        $reportdate = date('Y-m-d');
        $getannex_name = $request->input('getannex_name');

        switch($to){
            case 'comp':
                $insertDB = DB::table('reports')->insert(array(
                    'id' => null,
                    'type_of_report' => $typeofreport,
                    'message' => $message,
                    'report_date' => $reportdate,
                    'to_comp' => $getusercomp_id,
                    'to_annex' => null,
                    'from_tl_annex_name' => $getannex_name,
                    'name_of_annex_tl' => Auth::user()->name
                ));
        
                if($insertDB){
                    return view('sendreport',['success' => 'لقد تم اعلام الشركة']);
           }else{
               //else returning error
               return view('sendreport',['failed' => 'لا يمكن التسجيل حاليا حاول لاحقا']);
           }
           break;
           case 'an':
            $insertDB = DB::table('reports')->insert(array(
                'id' => null,
                'type_of_report' => $typeofreport,
                'message' => $message,
                'report_date' => $reportdate,
                'to_comp' => null,
                'to_annex' => $getannex_id,
                'from_tl_annex_name' => $getannex_name,
                'name_of_annex_tl' => Auth::user()->name
            ));
    
            if($insertDB){
                return view('sendreport',['success' => 'تم اعلام مدير الفرع بنجاح']);
       }else{
           //else returning error
           return view('sendreport',['failed' => 'لا يمكن التسجيل حاليا حاول لاحقا']);
       }
       break;
        }

        
    }
}
