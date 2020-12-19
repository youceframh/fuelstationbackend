<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class showPatrolsForAnnexDirector extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function get(){

    }

    public function post(Request $request){
        
    }
}
