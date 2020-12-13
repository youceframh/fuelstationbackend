<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class showcompanyinfos extends Controller
{
    public function __construct(){
        $this->middleware('auth.web');
    }
    public function get($id){
        if(preg_match('/^[1-9][0-9]*$/',$id)){
            $ids = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $get_company = DB::table('companies')->where('idcompanies',$ids)->get();
            $get_company_email = DB::table('companies')->where('idcompanies',$ids)->first()->email;
            $get_company_id_in_users = DB::table('users')->where('email',$get_company_email)->first()->id;
            $get_annexes_count = count(DB::table('annexes')->where('companies_id',$get_company_id_in_users)->get());
            return view ('show-company-infos',['company'=>json_decode($get_company,true),'annex_count'=>$get_annexes_count,'comp_id'=>$ids]);

        }else{
            return redirect('/dashboard/companies');
        }
           
    }
    public function post(Request $request,$id){
        
        if(preg_match('/^[1-9][0-9]*$/',$id)){
            $ids = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $typeofreq = $request->input('type');
            $get_company = DB::table('companies')->where('idcompanies',$ids)->get();
            switch($typeofreq){
                case 'accept':
                    $company = DB::table('companies')->where('idcompanies',$ids)->update([
                        'verified' => '1'
                    ]);
                    return view ('show-company-infos',['company'=>json_decode($get_company,true)]);
                break;
                case 'decline':
                    $company = DB::table('companies')->where('idcompanies',$ids)->update([
                        'verified' => '3'
                    ]);
                    return view ('show-company-infos',['company'=>json_decode($get_company,true)]);
                break;
                case 'download':
                    $company = DB::table('companies')->where('idcompanies',$ids)->get();
                    $getuserid = DB::table('users')->where('email',json_decode($company,true)['0']['email'])->get();
                    $getfile = DB::table('companies_files')->where('company_id',json_decode($getuserid,true)['0'])->first();

                    header("Content-Type: " . 'zip');
                   header("Content-Disposition: attachment; filename=\"" . $getfile->size .".zip" . "\"");

                    echo ($getfile->content);
            }
        }else{
            return redirect('/dashboard/companies');
        }
       
    }
    public function getannexesofcompany($id){
        $searchQuery;
        if(isset($_GET['searchquery'])){
          if(isset($id) && preg_match('/^[1-9][0-9]*$/',$id)){
            $ids = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $searchQuery = filter_var($_GET['searchquery'], FILTER_SANITIZE_STRING);
            $get_company_email = DB::table('companies')->where('idcompanies',$ids)->first()->email;
            $get_company_id_in_users = DB::table('users')->where('email',$get_company_email)->first()->id;
            $get_annexes = DB::table('annexes')->where('companies_id',$get_company_id_in_users)->where('name','like',"%$searchQuery%")->get();
            return view ('show-annexes-for-superuser',['annexes'=>$get_annexes,'comp_id'=>$ids]);
          }else{
            return redirect('/dashboard/companies');
          }
        }else{
          //  $get_companies = DB::table('annexes')->get();
          //  return view ('show-annexes-for-superuser',['companies'=>json_decode($get_companies,true)]);

            if(preg_match('/^[1-9][0-9]*$/',$id)){
                $ids = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
                $get_company_email = DB::table('companies')->where('idcompanies',$ids)->first()->email;
                $get_company_id_in_users = DB::table('users')->where('email',$get_company_email)->first()->id;
                $get_annexes = DB::table('annexes')->where('companies_id',$get_company_id_in_users)->get();
                return view ('show-annexes-for-superuser',['annexes'=>$get_annexes,'comp_id'=>$ids]);
    
            }else{
                return redirect('/dashboard/companies');
            }
    
        }
    }
    public function getannexesinfosofcompany($id,$id_an){

        if(isset($id) && isset($id_an)){
            if(preg_match('/^[1-9][0-9]*$/',$id) && preg_match('/^[1-9][0-9]*$/',$id_an)){

                $id_comp = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
                $id_annex = filter_var($id_an, FILTER_SANITIZE_NUMBER_INT);

                $get_annex = DB::table('annexes')->where('idannexes',$id_an)->get();
                $get_annex_team_leader = DB::table('employees')->where('annex_id',$id_an)->first();
                return view ('show-annexes-infos-for-superuser',['annex'=>json_decode($get_annex,true),'annex_TL'=>$get_annex_team_leader,'comp_id'=>$id_comp,'an_id'=>$id_annex]);

            }else{
                return redirect('/dashboard/companies');
            }

        }else{
            return redirect('/dashboard/companies');
        }
    }
   
    public function getpatrolsbydateforsuperuser($id,$id_an){
        if(isset($id) && isset($id_an)){
            if(preg_match('/^[1-9][0-9]*$/',$id) && preg_match('/^[1-9][0-9]*$/',$id_an)){

                $id_comp = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
                $id_annex = filter_var($id_an, FILTER_SANITIZE_NUMBER_INT);

                if(isset($_GET['date'])){
                    $Unsanitized_date = $_GET['date'];
                    if(preg_match('/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/',$Unsanitized_date)){
                        $official_date = $_GET['date'];


      if(DB::table('patrol')->where('annex_id',$id_annex)->where('date',$official_date)->get() != "[]"){

        $last_table_infos_getting_iddaily = $get_gas_pomps = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$id_annex)->where('date',$official_date)->first()->iddaily;
        $fuel_prices = DB::table('fuel_price')->get();
        $last_table_infos = DB::table('patrol_summ')->where('iddaily',$last_table_infos_getting_iddaily)->first();
        
        $get_gas_pomps = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$id_annex)->where('date',$official_date)->get();
        $get_name_of_saver = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$id_annex)->where('date',$official_date)->first()->name_of_saver;

        $get_diesel_pomps = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$id_annex)->where('date',$official_date)->get();
        $get_es91_pomps = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$id_annex)->where('date',$official_date)->get();
        $get_es95_pomps = DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$id_annex)->where('date',$official_date)->get();

        return view('patrol-show',['diesel_pomps'=>$get_diesel_pomps,'team_leader_annex'=>$id_annex,'saver_name'=> $get_name_of_saver,'gas_pomps'=>$get_gas_pomps,'last_table'=>$last_table_infos,'fuelprices'=>$fuel_prices],['es91_pomps'=>$get_es91_pomps,'es95_pomps'=>$get_es95_pomps,'comp_id'=>$id_comp,'an_id'=>$id_annex]);
      
    }else{
        
        die('<center><b>لا يوجد تسجيل بلتاريخ المطلوب</b></center>');
      }


                    }else{
                        return redirect('/dashboard/companies');
                    }
                }else{ //if couldn't get date
                    return view('choose-date',['comp_id'=>$id_comp,'an_id'=>$id_annex]);
                } 

                //$get_annex = DB::table('annexes')->where('idannexes',$id_an)->get();
               // $get_annex_team_leader = DB::table('employees')->where('annex_id',$id_an)->first();
                //return view ('show-annexes-infos-for-superuser',['annex'=>json_decode($get_annex,true),'annex_TL'=>$get_annex_team_leader,'comp_id'=>$id_comp,'an_id'=>$id_annex]);

            }else{
                return redirect('/dashboard/companies');
            }

        }else{
            return redirect('/dashboard/companies');
        }
    }

}
