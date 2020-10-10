<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\IsCurrentPassword;
use Illuminate\Support\Facades\Hash;
use Auth;

class dashboardprofile extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(){
       return view('dashboard-profile',['pic' => Auth::user()->picture ]);
    }

    public function post(Request $request){

        if(empty($request->input('oldpassword'))){
            $validation = $request->validate([
                'name' => ['string'],
                'phone' => ['numeric','min:8'],
                'email' => ['email'],
            ]);

            
           $insert =  auth()->user()->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
            ]);

            if($insert){
                return view('dashboard-profile',['success' => 'تم التغيير بنجاح']);
            }else{
                return view('dashboard-profile',['success' => 'لا يمكن التغيير حاليا حاول لاحقا']);
            }

        }else{
            $validation = $request->validate([
                'oldpassword' => ['required', new IsCurrentPassword],
                'newpassword' => ['required','string','min:8'],
                'password_confirmation' => ['required','min:8','same:newpassword'],
            ]);

           $insert =  auth()->user()->update([
                'password' => Hash::make($request->newpassword)
            ]);

            if($insert){
                return view('dashboard-profile',['success' => 'تم التغيير بنجاح']);
            }else{
                return view('dashboard-profile',['success' => 'لا يمكن التغيير حاليا حاول لاحقا']);
            }
        }
        
    } //adding profile picture
}
