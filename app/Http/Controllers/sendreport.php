<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class sendreport extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(){
        return view('sendreport');
    }

    public function post(Request $request){
        $validation = $request->validate([
            'reporttype' => ['required','string'],
            'report' => ['required','string'],
            'reportnbr' => ['required','numeric'],
            'datePicker' => ['nullable','date'],
        ]);

        $typeofreport = $request->input('reporttype');
        $message = $request->input('report');
        $reportnbr = $request->input('reportnbr');
        $reportdate = date('Y-m-d');;

        $insertDB = DB::table('reports')->insert(array(
            'id' => null,
            'type of report' => $typeofreport,
            'message' => $message,
            'report number' => $reportnbr,
            'report date' => $reportdate,
        ));

        if($insertDB){
            return view('sendreport',['success' => 'تم التسجيل بنجاح']);
   }else{
       //else returning error
       return view('sendreport',['failed' => 'لا يمكن التسجيل حاليا حاول لاحقا']);
   }
    }
}
