<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class reportsshowAnnex extends Controller
{
    public function __construct()
    {
        $this->middleware('annex'); // restricting this page for annex users only
    }

    public function get(){
        $getAuthUserEmail = Auth::user()->email;
        $getAnnexId = DB::table('annexes')->where('email',$getAuthUserEmail)->first()->idannexes;
        $getReports = DB::table('reports')->where('to_annex',$getAnnexId)->orderBy('report_date', 'desc')->get();
        return view('show-reports',['reports'=>$getReports]);
    }

    public function showcompreports(){
        $getAuthUserEmail = Auth::user()->email;
        $getannexUnderComp = DB::table('annexes')->where('email',$getAuthUserEmail)->first()->companies_id;
        $getReports = DB::table('report_from_company')->where('comp_id',$getannexUnderComp)->orderBy('date', 'desc')->get();
        return view('show-reports-from-comp',['reports'=>$getReports]);
        
    }

}
