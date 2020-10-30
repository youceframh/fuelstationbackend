<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login;
use App\Http\Controllers\register;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\registercompanies;
use App\Http\Controllers\registeremployee;
use App\Http\Controllers\registersuppliers;
use App\Http\Controllers\registerannex;
use App\Http\Controllers\registershops;
use App\Http\Controllers\registerrentshops;
use App\Http\Controllers\sendreport;
use App\Http\Controllers\registertank;
use App\Http\Controllers\registerpomp;
use App\Http\Controllers\registerdelegate;
use App\Http\Controllers\maintenance;
use App\Http\Controllers\registerpatrol;
use App\Http\Controllers\dashboardprofile;
use App\Http\Controllers\profilepic;
use App\Http\Controllers\submitdocuments;
use App\Http\Controllers\showcompanies;
use App\Http\Controllers\showcompanyinfos;
use App\Http\Controllers\showannexes;
use App\Http\Controllers\showannexesinfos;
use App\Http\Controllers\patrolshow;
use App\Http\Controllers\patroladd;

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



//verifying register information through registerverify() in register controller

//Getting dashboard and verifying if user is loggedin  page
Route::get('/dashboard',function(Request $request){
    if (Auth::check()) {
        return view('dashboard-main');
    }
    return redirect()->route('login');
});

//Getting dashboard company profile  page and verifying if user is loggedin 
Route::get('/dashboard/profile', [dashboardprofile::class,'get']);

Route::post('/dashboard/profile', [dashboardprofile::class,'post']);


//dependent sect 

//Getting all companies
Route::get('/dashboard/companies', [showcompanies::class,'get']);


//Getting dashboard company profile  page and verifying if user is loggedin 
Route::get('/dashboard/companies/{id}', [showcompanyinfos::class,'get']);

Route::post('/dashboard/companies/{id}', [showcompanyinfos::class,'post']);

//Getting dashboard company profile  page and verifying if user is loggedin 
Route::get('/dashboard/annexes', [showannexes::class,'get']);

//Getting dashboard company profile  page and verifying if user is loggedin 
Route::get('/dashboard/annexes/{id}', [showannexesinfos::class,'get']);
Route::post('/dashboard/annexes/{id}', [showannexesinfos::class,'post']);

//end

//Getting dashboard user balance page and verifying if user is loggedin 
Route::get('/dashboard/balance',function(Request $request){
    if (Auth::check()) {
        return view('dashboard-accountbalance');
    }
    return redirect()->route('login');
});

//Getting dashboard add (tank,annex,pomp) page and verifying if user is loggedin 
Route::get('/dashboard/add',function(Request $request){
    if (Auth::check()) {
        return view('dashboard-add');
    }
    return redirect()->route('login');
});

//Getting dashboard company's (tanks,annexs,pomps) page and verifying if user is loggedin 
Route::get('/dashboard/show',function(Request $request){
    if (Auth::check()) {
        return view('dashboard-show');
    }
    return redirect()->route('login');
});

Route::get('/logout',[LoginController::class,'logout']); // making logout page

Auth::routes(); // activating the auth routes


Route::get('/register/companies', [registercompanies::class,'get'])->middleware('auth'); // Getting Companies registration page

Route::post('/register/companies',[registercompanies::class,'post'])->middleware('auth'); // Creating Companies route in association with db

Route::get('/register/employee', [registeremployee::class,'get']); // Getting employees registration page
 
Route::post('/register/employee',[registeremployee::class,'post']); // Creating employees route in association with db

Route::get('/register/suppliers',[registersuppliers::class,'get']); // Getting suppliers registration page

Route::post('/register/suppliers',[registersuppliers::class,'post']); // Creating suppliers route in association with db

Route::get('/register/annex',[registerannex::class,'get']); // Getting annex registration page

Route::post('/register/annex',[registerannex::class,'post']); // Creating annex route in association with db

Route::get('/register/shop',[registershops::class,'get']); // Getting shops registration page

Route::post('/register/shop',[registershops::class,'post']); // Creating shops route in association with db

Route::get('/register/rent/shops',[registerrentshops::class,'get']); // Getting shops renting registration page

Route::post('/register/rent/shops',[registerrentshops::class,'post']); // Creating shops route in association with db

Route::get('/sendreport',[sendreport::class,'get']);  // Getting send report page 

Route::post('/sendreport',[sendreport::class,'post']); // Creating send report route in association with db

Route::get('/register/tank',[registertank::class,'get']); // Getting tanks registration page

Route::post('/register/tank',[registertank::class,'post']); // Creating tanks route in association with db

Route::get('/register/pomp',[registerpomp::class,'get']); // Getting pomps registration page

Route::post('/register/pomp',[registerpomp::class,'post']); // Creating pomps route in association with db

Route::get('/register/delegate',[registerdelegate::class,'get']); // Getting delegates registration page

Route::post('/register/delegate',[registerdelegate::class,'post']); // Creating delegates route in association with db

Route::get('/maintenance ',[maintenance::class,'get']); // Getting maintenance page

Route::post('/maintenance',[maintenance::class,'post']); // Creating maintenance route in association with db

Route::get('/register/patrol ',[registerpatrol::class,'get']); // Getting patrol registration page

Route::post('/register/patrol',[registerpatrol::class,'post']); // Creating patrol route in association with db

Route::put('/dashboard/profilepic',[profilepic::class,'post']);

Route::get('/dashboard/profilepic',[profilepic::class,'get']);


Route::get('/submitdocuments',[submitdocuments::class,'get']);

Route::post('/submitdocuments',[submitdocuments::class,'post']);

Route::get('/patrol/show',[patrolshow::class,'get']);

Route::post('/patrol/show',[patrolshow::class,'post']);

Route::get('/patrol/add',[patroladd::class,'get']);

Route::post('/patrol/add',[patroladd::class,'post']);

//maintenance