<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;


class registerrentshops extends Controller 
{
    public function __construct(){
        $this->middleware('annex'); 
    }

    public function get(){
        return view('register-rent-shop'); //returning view of shop registrations html and css page
    }

    public function post(Request $request){
       $rent_type = $request->input('rentshoptype'); //checking type of rent

       switch($rent_type){
           case 'INDIVIDUAL' : //in case individual
          
             $validation = $request->validate([ //validate all inputs
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
             //setting all variables
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

             $insertDB = DB::table('rent_shop')->insert( array ( //inserting into table
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

            if($insertDB){ //confirming insert
                return view('register-rent-shop',['success' => 'تم تسجيل المحل بنجاح']);
       }else{
           //else returning error
           return view('register-rent-shop',['failed' => 'لا يمكن تسجيل المحل حاليا حاول لاحقا']);
       }
           break;

            case 'COMPANY' : //in case of company
              $validation = $request->validate([ //validate inputs
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
                //setting vars 
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
             
              $insertDB = DB::table('rent_shop')->insert( array ( //inserting fields into db table named rent_shop
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
 
             if($insertDB){ //retuning infos about the insert
                 return view('register-rent-shop',['success' => 'تم تسجيل المحل بنجاح']);
        }else{
            //else returning error
            return view('register-rent-shop',['failed' => 'لا يمكن تسجيل المحل حاليا حاول لاحقا']);
        }
            break;

       }
    }
}
