<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

/*ALTER TABLE `suppliers` ADD 
id
name
`number` VARCHAR(255) NOT NULL AFTER `name`, ADD 
`general director name` VARCHAR(255) NOT NULL AFTER `number`, ADD
`general director number` VARCHAR(255) NOT NULL AFTER `general director name`, ADD
`adress` VARCHAR(255) NOT NULL AFTER `general director number`, ADD
 `city` VARCHAR(255) NOT NULL AFTER `adress`, ADD
 `country` VARCHAR(255) NOT NULL AFTER `city`, ADD 
 `fat number` INT(55) NOT NULL AFTER `country`, ADD
 `email` VARCHAR(255) NOT NULL AFTER `fat number`, ADD
`opening credit` VARCHAR(255) NOT NULL AFTER `email`, ADD
`add time` DATE NOT NULL AFTER `opening credit`, ADD
`serial id` VARCHAR(255) NOT NULL AFTER `add time`, ADD
`notes` LONGTEXT NOT NULL AFTER `serial id`, ADD
`product type` VARCHAR(255) NOT NULL AFTER `notes`, ADD
`volume` VARCHAR(255) NOT NULL AFTER `product type`, ADD
`aramco inovice number` VARCHAR(255) NOT NULL AFTER `volume`, ADD
`truck number` INT(55) NOT NULL AFTER `aramco inovice number`, ADD
 `name of person` VARCHAR(255) NOT NULL AFTER `truck number`, ADD
`time` TIME NOT NULL AFTER `name of person`;
 */

class registersuppliers extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(){
        return view('register-suppliers');
    }

    public function post(Request $request){
        //verification of inputs and their types
      $verification =  $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:255'],
            'dgname' => ['required', 'string', 'max:255'],
            'dgphone' => ['required', 'digits_between:8,15', 'min:8'],
            'adress' => ['required', 'string', 'min:2'],
            'city' => ['required', 'string', 'min:2'],
            'country' => ['required', 'string', 'min:2'],
            'taxnumber' => ['required', 'digits_between:1,255', 'min:2'],
            'email' => ['required', 'email'],
            'openingcredit' =>[ 'required', 'string'],
            'addtime' => ['required', 'date'],
            'serialid' => ['required','string'],
            'notes' => ['required', 'string'],
            'producttype' => ['required', 'string', 'min:2'],
            'volume' => ['required', 'string', 'min:2'],
            'aramcoinovicenbr' => ['required', 'string'],
            'trucknbr' => ['required', 'numeric'],
            'personname' => ['required', 'string'],
            'time' => ['required', 'string'],
        ]);
        //if verification goes well 
           if($verification){
               //make inputs inside vars
               $name = $request->input('name');
               $number =$request->input('number') ;
               $dgname =$request->input('dgname') ;
               $dgphone = $request->input('dgphone');
               $adress = $request->input('adress');
               $city = $request->input('city') ;
               $country = $request->input('country');
               $taxnumber = $request->input('taxnumber');
               
               $email = $request->input('email') ;
               $openingcredit = $request->input('openingcredit');
               $addtime =$request->input('addtime') ;
               $serialid = $request->input('serialid');
               $notes = $request->input('notes');

               $producttype = $request->input('producttype') ;
               $volume = $request->input('volume');
               $aramcoinovicenbr = $request->input('aramcoinovicenbr') ;
               $trucknbr = $request->input('trucknbr');
               $personname = $request->input('personname') ;
               $time = $request->input('time');

               //insert into db the infos 
               $insertDB = DB::table('suppliers')->insert( array (
                   'idsuppliers' => null,
                   'name' => $name,
                   'number' => $number,
                   'general director name' => $dgname,
                   'general director number' => $dgphone,
                   'adress' => $adress,
                   'city' => $city,
                   'country' => $country ,
                   'fat number' => $taxnumber,
                   'email' => $email,
                   'opening credit' => $openingcredit,
                   'add time' => $addtime,
                   'serial id' => $serialid,
                   'notes' => $notes,
                   'product type' => $producttype, 
                   'volume' => $volume,  
                   'aramco inovice number' => $aramcoinovicenbr,
                   'truck number' => $trucknbr, 
                   'name of person' => $personname,  
                   'time' => $time,
               )); //don't forget to add password
               //checking the status
                    if($insertDB){
                        return view('register-companies',['success' => 'تم التسجيل بنجاح']);
               }else{
                   //else returning error
                   return view('register-companies',['failed' => 'لا يمكن التسجيل حاليا حاول لاحقا']);
               }
           }
    }
}