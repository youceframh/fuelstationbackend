<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class showannexes extends Controller
{
    public function __construct(){
        $this->middleware('company.status');
    }
    public function get(){

        $searchQuery;
        if(isset($_GET['searchquery'])){
            $searchQuery = filter_var($_GET['searchquery'], FILTER_SANITIZE_STRING);
            $getcomapnyid = Auth::user()->id;
            $get_annexes = DB::table('annexes')->where('companies_id',$getcomapnyid)->where('name','like',"%$searchQuery%")->get();
            return view ('show-annexes',['annexes'=>json_decode($get_annexes,true)]);
        }else{
            $getcomapnyid = Auth::user()->id;
            $get_annexes = DB::table('annexes')->where('companies_id',$getcomapnyid)->get();
            return view ('show-annexes',['annexes'=>json_decode($get_annexes,true)]);
        }

    
    }
    public function post(Request $request){

    }
}
