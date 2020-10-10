<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class profilepic extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(){
        return view('dashboard-profile',['pic' => Auth::user()->picture ]);
    }

    public function post(Request $request){

     
    }

}
