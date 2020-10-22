<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class showcompanies extends Controller
{
    public function __construct(){
        $this->middleware('auth.web');
    }
    public function get(){
        $get_companies = DB::table('companies')->get();
        return view ('show-companies',['companies'=>json_decode($get_companies,true)]);
    }
    public function post(Request $request){

    }
}
