<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class companieslogin extends Controller
{
    protected $table = 'companies';
    public function guard()
    {
     return Auth::guard('companies');
    }

    use AuthenticatesUsers;
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     **_ Create a new controller instance.
     
     **_ @return void
     */

    public function __construct()
    {
      $this->middleware('guest')->except('logout');
      $this->middleware('guest:web')->except('logout');
      $this->middleware('guest:companies')->except('logout');
    }
    /*
     _
     _ @return property guard use for login
     _
     _*/

    // login from for teacher
    public function showLoginForm()
    {
        return view('logincompany');
    }

    public function getAuthPassword()
    {
        return $this->Password; // case sensitive
    }

 }
