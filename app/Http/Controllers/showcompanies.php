<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class showcompanies extends Controller
{
    public function __construct(){
        $this->midlleware('auth.web');
    }
    public function get(){
        return ('show-companies');
    }
    public function post(Request $request){
        
    }
}
