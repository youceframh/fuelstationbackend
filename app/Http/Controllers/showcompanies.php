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

        $searchQuery;
        if(isset($_GET['searchquery'])){
            $searchQuery = filter_var($_GET['searchquery'], FILTER_SANITIZE_STRING);
            $get_companies = DB::table('companies')->where('commercial name','like',"%$searchQuery%")->get();
            return view ('show-companies',['companies'=>json_decode($get_companies,true)]);
        }else{
            $get_companies = DB::table('companies')->get();
            return view ('show-companies',['companies'=>json_decode($get_companies,true)]);
        }

    
    }
    public function post(Request $request){

    }
}
