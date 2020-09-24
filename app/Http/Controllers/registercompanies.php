<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class registercompanies extends Controller
{
    public function get(){
        return view('register-companies');
    }

    public function post(Request $request){

         $request->validate([
            'commercialname' => 'required', 'string', 'max:255',
            'firstname' => 'required', 'string', 'max:255',
            'lastname' => 'required', 'string', 'max:255',
            'phone' => 'required', 'numeric', 'min:8',
            'country' => 'required', 'string', 'min:2',
            'city' => 'required', 'string', 'min:2',
            'state' => 'required', 'string', 'min:2',
            'zip' => 'required', 'numeric', 'min:3',
            'language' => 'required', 'string', 'min:3',
            'taxnumber' => 'required', 'numeric', 'min:3',
            'commercialnumber' => 'required', 'numeric', 'min:3',
            'adress1' => 'required', 'numeric', 'min:3',
            'adress2' => 'required', 'numeric', 'min:3',
            'logo' => 'required', 'file',
        ]);

            error_log('accessedddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd');

    }
}
