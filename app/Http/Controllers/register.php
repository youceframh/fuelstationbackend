<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class register extends Controller
{
    
    public function registershow(){ // function for returning register html page
        return view('register');
    }

    public function registerverify(Request $request){ // verifying register information
        //verify inputs 

        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'passwordverify' => 'required|min:8|same:password',
        ]);

        $fullname = $request->input('fullname');
        $email = $request->input('email');
        $password = $request->input('password');
        $passwordv = $request->input('passwordverify');
        echo($fullname." ".$email." ".$password." ".$passwordv);
    }
}
