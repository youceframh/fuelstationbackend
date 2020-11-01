<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class fuelprices extends Controller
{
    public function __construct()
    {
        $this->middleware('company'); 
    }

    public function get(){

    }

    public function post(){

    }
}
