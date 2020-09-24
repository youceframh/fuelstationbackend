<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login;
use App\Http\Controllers\register;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\registercompanies;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//getting main landing page
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register/companies', [registercompanies::class,'get']);

Route::post('/register/companies',[registercompanies::class,'post']);


//verifying register information through registerverify() in register controller

//Getting dashboard and verifying if user is loggedin  page
Route::get('/dashboard',function(Request $request){
    if (Auth::check()) {
        return view('dashboard-main');
    }
    return redirect()->route('home');
});

//Getting dashboard company profile  page and verifying if user is loggedin 
Route::get('/dashboard/profile',function(Request $request){
    if (Auth::check()) {
        return view('dashboard-profile');
    }
    return redirect()->route('home');
    
});

//Getting dashboard user balance page and verifying if user is loggedin 
Route::get('/dashboard/balance',function(Request $request){
    if (Auth::check()) {
        return view('dashboard-accountbalance');
    }
    return redirect()->route('home');
});

//Getting dashboard add (tank,annex,pomp) page and verifying if user is loggedin 
Route::get('/dashboard/add',function(Request $request){
    if (Auth::check()) {
        return view('dashboard-add');
    }
    return redirect()->route('home');
});

//Getting dashboard company's (tanks,annexs,pomps) page and verifying if user is loggedin 
Route::get('/dashboard/show',function(Request $request){
    if (Auth::check()) {
        return view('dashboard-show');
    }
    return redirect()->route('home');
});

Route::get('/logout',[LoginController::class,'logout']); // making logout page

Auth::routes(); // activating the auth routes

