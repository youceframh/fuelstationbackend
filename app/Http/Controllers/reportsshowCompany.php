<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class reportsshowCompany extends Controller
{
    public function __construct()
    {
        $this->middleware('company'); // restrcting this page to companies only
    }

    public function get(){
        $getAuthUserEmail = Auth::user()->email;
        $getCompanyID = DB::table('users')->where('email',$getAuthUserEmail)->first()->id;
        $getReports = DB::table('reports')->where('to_comp',$getCompanyID)->orderBy('report_date', 'desc')->get();
        return view('show-reports',['reports'=>$getReports]);
    }

    public function showpatrolchangesnotifications(){
        $getAuthUserEmail = Auth::user()->email;
        $getCompanyID = DB::table('users')->where('email',$getAuthUserEmail)->first()->id;
        $getNotifs = DB::table('patrol_changes_notifications')->where('id_comp',$getCompanyID)->orderBy('changed_on', 'desc')->get();
        return view('show-patrol-changes-notifs',['notifs'=>$getNotifs]);
    }
}
