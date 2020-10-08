<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardprofile extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(){
       return view('dashboard-profile');
    }

    public function post(){
        die('post');
    }
}
