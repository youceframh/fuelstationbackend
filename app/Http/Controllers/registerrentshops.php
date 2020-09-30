<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

/*
CREATE TABLE `fuelstation`.`rent_shop` (
     `id` INT NOT NULL AUTO_INCREMENT ,
      `full name` VARCHAR(255) NOT NULL ,
       `phone number` VARCHAR(255) NOT NULL ,
        `address` VARCHAR(255) NOT NULL ,
         `nationality` VARCHAR(255) NOT NULL ,
          `rent type` VARCHAR(15) NOT NULL ,
           `id type` VARCHAR(255) NOT NULL ,
            `id number` BIGINT NOT NULL ,
             `commercial number` VARCHAR(255) NULL ,
              `representative name` VARCHAR(255) NULL ,
               `representative number` INT NULL ,
                `representative id number` INT NULL ,
                 `id authority` VARCHAR(255) NULL ,
                  `id expire date` DATE NULL ,
                   ` rent start date` DATE NOT NULL ,
                    `rent end date` DATE NOT NULL ,
                     `price` INT NOT NULL ,
                      `electricity number` INT NOT NULL ,
                       `water number` INT NOT NULL ,
                        `activity type` VARCHAR(255) NOT NULL ,
                         `payment type` VARCHAR(255) NOT NULL ,
                          `shop type` VARCHAR(255) NOT NULL ,
                           `notes` LONGTEXT NOT NULL ,
                            `rent conditions` LONGTEXT NOT NULL ,
                             PRIMARY KEY (`id`)
                             ) ENGINE = MyISAM;

*/
class registerrentshops extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function get(){
        return view('register-rent-shop');
    }

    public function post(Request $request){
       $rent_type = $request->input('rentshoptype');

       switch($rent_type){
           case 'INDIVIDUAL' :
          
             $validation = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'digits_between:8,15', 'min:8'],
                'address' => ['required', 'string', 'min:2'],
                'nationality' => ['required', 'string', 'min:2'],
                'rentshoptype' => ['required', 'string'],
                'idcardtype' => ['required','string'],
                'idcardnbr' => ['required', 'numeric'],
                'rentdatestart' => ['required','date'],
                'rentdateend' => ['required','date'],
                'rentprice' => ['required', 'numeric'],
                'electricitynbr' => ['required', 'numeric'],
                'waternbr' => ['required', 'numeric'],
                'activitytype' => ['required', 'string'],
                'paymenttype' => ['required', 'string'],
                'shoptype' => ['required', 'string'],
                'notes' => ['required', 'string'],
                'rentconditions' => ['required', 'string'],
             ]);
             
             $name = $request->input('name');
             $adress = $request->input('address');
             $phone = $request->input('phone');
             $nationality = $request->input('nationality');
             $rentshoptype = $request->input('rentshoptype') ;
             $idcardtype = $request->input('idcardtype');
             $idcardnbr = $request->input('idcardnbr');
             $rentdatestart = $request->input('rentdatestart');//req
             $rentdateend = $request->input('rentdateend');
             $price = $request->input('rentprice');
             $electricitynbr = $request->input('electricitynbr');
             $waternbr = $request->input('waternbr');
             $activitytype = $request->input('activitytype');
             $paymenttype = $request->input('paymenttype');
             $shoptype = $request->input('shoptype');
             $notes = $request->input('notes');
             $rentconditions = $request->input('rentconditions');
             $company_id = Auth::user()->id;

             $insertDB = DB::table('rent_shop')->insert( array (
                'id' => null,
                'full name' => $name,
                'phone number' => $phone,
                'address' => $adress,
                'nationality' => $nationality ,
                'rent type' => $rentshoptype,
                'id type' => $idcardtype,
                'id number' => $idcardnbr,
                'commercial number' => null,
                'representative name' => null ,
                'representative number' => null,
                'representative id number' => null,
                'id authority' => null,
                'id expire date' => null ,
                'rent start date' => $rentdatestart,
                'rent end date' => $rentdateend,
                'price' => $price,
                'electricity number' => $electricitynbr ,
                'water number' => $waternbr,
                'activity type' => $activitytype,
                'payment type' => $paymenttype ,
                'shop type' => $shoptype,
                'notes' => $notes,
                'rent conditions' => $rentconditions,
                'company_id' => $company_id,
            ));

            if($insertDB){
                return view('register-rent-shop',['success' => 'تم تسجيل المحل بنجاح']);
       }else{
           //else returning error
           return view('register-rent-shop',['failed' => 'لا يمكن تسجيل المحل حاليا حاول لاحقا']);
       }
           break;

            case 'COMPANY' :
              $validation = $request->validate([
                 'name' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'digits_between:8,15', 'min:8'],
                'address' => ['required', 'string', 'min:2'],
                'nationality' => ['required', 'string', 'min:2'],
                'rentshoptype' => ['required', 'string'],
                'idcardtype' => ['required','string'],
                'idcardnbr' => ['required', 'numeric'],
                 'commercialnbr' =>['required', 'numeric'],
                 'representativename' => ['required', 'string'],
                 'representativetype' => ['required','string'],
                 'representativeidcardnumber' => ['required','numeric'],
                 'authorityofidcard' => ['required','string'],
                 'idcardexpiredate' => ['required','date'],
                 'representativeidcardnumber' => ['required','string'],
                 'rentdatestart' => ['required','date'],
                'rentdateend' => ['required','date'],
                'rentprice' => ['required', 'numeric'],
                'electricitynbr' => ['required', 'numeric'],
                'waternbr' => ['required', 'numeric'],
                'activitytype' => ['required', 'string'],
                'paymenttype' => ['required', 'string'],
                'shoptype' => ['required', 'string'],
                'notes' => ['required', 'string'],
                'rentconditions' => ['required', 'string'],
              ]);
 
              $name = $request->input('name');
              $adress = $request->input('address');
              $phone = $request->input('phone');
              $nationality = $request->input('nationality');
              $rentshoptype = $request->input('rentshoptype') ;
              $idcardtype = $request->input('idcardtype');
              $idcardnbr = $request->input('idcardnbr');
              $commercialnbr = $request->input('commercialnbr');//notreq
              $representativename = $request->input('representativename');
              $representativetype = $request->input('representativetype');
              $representativeidcardnumber = $request->input('representativeidcardnumber');
              $authorityofidcard = $request->input('authorityofidcard');
              $idcardexpiredate = $request->input('idcardexpiredate');
              $representativeidcardnumber = $request->input('representativeidcardnumber');
              $rentdatestart = $request->input('rentdatestart');//req
              $rentdateend = $request->input('rentdateend');
              $price = $request->input('rentprice');
              $electricitynbr = $request->input('electricitynbr');
              $waternbr = $request->input('waternbr');
              $activitytype = $request->input('activitytype');
              $paymenttype = $request->input('paymenttype');
              $shoptype = $request->input('shoptype');
              $notes = $request->input('notes');
              $rentconditions = $request->input('rentconditions');
              $company_id = Auth::user()->id;
             
              $insertDB = DB::table('rent_shop')->insert( array (
                'id' => null,
                'full name' => $name,
                'phone number' => $phone,
                'address' => $adress,
                'nationality' => $nationality ,
                'rent type' => $rentshoptype,
                'id type' => $idcardtype,
                'id number' => $idcardnbr,
                 'commercial number' => $commercialnbr,
                 'representative name' => $representativename ,
                 'representative number' => $representativetype,
                 'representative id number' => $representativeidcardnumber,
                 'id authority' => $authorityofidcard,
                 'id expire date' => $idcardexpiredate,
                 'rent start date' => $rentdatestart,
                 'rent end date' => $rentdateend,
                 'price' => $price,
                 'electricity number' => $electricitynbr ,
                 'water number' => $waternbr,
                 'activity type' => $activitytype,
                 'payment type' => $paymenttype ,
                 'shop type' => $shoptype,
                 'notes' => $notes,
                 'rent conditions' => $rentconditions,
                 'company_id' => $company_id,
             ));
 
             if($insertDB){
                 return view('register-rent-shop',['success' => 'تم تسجيل المحل بنجاح']);
        }else{
            //else returning error
            return view('register-rent-shop',['failed' => 'لا يمكن تسجيل المحل حاليا حاول لاحقا']);
        }
            break;

       }
    }
}
