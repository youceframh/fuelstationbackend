<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class addfuel extends Controller
{
    public function __construct(){
        $this->middleware('teamleader');
    }

    public function get(){
        $team_leader_email = Auth::user()->email;
        $team_leader_annex = DB::table('employees')->where('email',$team_leader_email)->first()->annex_id;
        $team_leader_tanks = DB::table('tanks')->where('annex_id',$team_leader_annex)->get();

        return view('add-fuel',['tanks'=>$team_leader_tanks]);
    }

    public function post(Request $request){
        //for get redirection
        $team_leader_email = Auth::user()->email;
        $team_leader_annex = DB::table('employees')->where('email',$team_leader_email)->first()->annex_id;
        $team_leader_comp_id = DB::table('annexes')->where('idannexes',$team_leader_annex)->first()->companies_id;
        $team_leader_tanks = DB::table('tanks')->where('annex_id',$team_leader_annex)->get();
        //

        $validation = $request->validate([
            'tanknbr' => ['string','required'],
            'aramconbr' => ['string','required'],
            'inovicenbr' => ['string','required'],
            'trucknbr' => ['string','required'],
            'amountpayed' => ['numeric','required'],
            'facturepic' => ['required','file','mimes:jpg,jpeg,png'],
        ]);

        if($validation){
            $tanknbr = $request->input('tanknbr');
            $aramconbr = $request->input('aramconbr');
            $inovicenbr = $request->input('inovicenbr');
            $trucknbr = $request->input('trucknbr');
            $amountpayed = $request->input('amountpayed');

            $facturepic = $request->facturepic;
            $facturepicSize = $facturepic->getSize();
            $faturepicmime = $facturepic->getMimeType();
            $facturepicActualFile = file_get_contents(($facturepic->getRealPath()));

            
            $insetDB = DB::table('addfuelrepayment_and_addfuel_infos')->insert(array(
                'id' => null,
                'annex_id' => $team_leader_annex,
                'comp_id' => $team_leader_comp_id,
                'date_of_last_addition' => date('Y-m-d'),
                'amount_spend' => $amountpayed,
                'aramco_number' => $aramconbr,
                'inovice_number' => $inovicenbr,
                'tank_id' => $tanknbr,
                'truck_number' =>$trucknbr,
                'facture_img' => $facturepicActualFile,
                'facture_img_size' => $facturepicSize,
                'facture_img_type' => $faturepicmime
            ));

            if($insetDB){
                return view('add-fuel',['tanks'=>$team_leader_tanks,'success'=>'تم التسجيل بنجاح','tank_id'=>$tanknbr]);
            }else{
                return view('add-fuel',['tanks'=>$team_leader_tanks,'failed'=>'حصل خطا حاول مجددا']);
            }

        }

    }

    public function print($tank_id){
        $team_leader_email = Auth::user()->email;
        $team_leader_annex = DB::table('employees')->where('email',$team_leader_email)->first()->annex_id;
        $team_leader_tanks = DB::table('tanks')->where('annex_id',$team_leader_annex)->get();
        $tank_nbr = filter_var($tank_id,FILTER_SANITIZE_NUMBER_INT);

        $get_facture_infos = DB::table('addfuelrepayment_and_addfuel_infos')->where('annex_id',$team_leader_annex)->where('tank_id',$tank_nbr)->first();
        if($get_facture_infos){
            return view('print-infos-of-addfuel',['facture'=>$get_facture_infos]);
        }else{
            return redirect('/addfuel');
        }
       
    }
}
