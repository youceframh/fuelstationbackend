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
            $get_company_email = DB::table('companies')->where('idcompanies',$ids)->first()->email;
            $get_company_id_in_users = DB::table('users')->where('email',$get_company_email)->first()->id;
            $get_annexes_count = count(DB::table('annexes')->where('companies_id',$get_company_id_in_users)->get());
            switch($typeofreq){
                case 'accept':
                    $company = DB::table('companies')->where('idcompanies',$ids)->update([
                        'verified' => '1'
                    ]);
                    return view ('show-company-infos',['company'=>json_decode($get_company,true),'annex_count'=>$get_annexes_count,'comp_id'=>$ids]);
                break;
                case 'decline':
                    $company = DB::table('companies')->where('idcompanies',$ids)->update([
                        'verified' => '3'
                    ]);
                    return view ('show-company-infos',['company'=>json_decode($get_company,true),'annex_count'=>$get_annexes_count,'comp_id'=>$ids]);
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

        $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$id_annex)->where('date',$official_date)->first()->iddaily;
        $fuel_prices = DB::table('fuel_price')->get();
        $last_table_infos = DB::table('patrol_summ')->where('iddaily',$last_table_infos_getting_iddaily)->first();
        
        $get_gas_pomps = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$id_annex)->where('date',$official_date)->get();

        $get_name_of_saver;

        if(DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('date',$official_date)->first()){
            $get_name_of_saver = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('date',$official_date)->first()->name_of_saver;
        }elseif(DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('date',$official_date)->first()){
            $get_name_of_saver = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('date',$official_date)->first()->name_of_saver;
        }elseif(DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('date',$official_date)->first()){
            $get_name_of_saver = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('date',$official_date)->first()->name_of_saver;
        }elseif(DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('date',$official_date)->first()){
            $get_name_of_saver = DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('date',$official_date)->first()->name_of_saver;
        }

        $get_diesel_pomps = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$id_annex)->where('date',$official_date)->get();
        $get_es91_pomps = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$id_annex)->where('date',$official_date)->get();
        $get_es95_pomps = DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$id_annex)->where('date',$official_date)->get();

        $last_table_infos_getting_iddaily;

        if(DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$id_annex)->where('date',$official_date)->first()){
            $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$id_annex)->where('date',$official_date)->first()->iddaily;
        }elseif(DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$id_annex)->where('date',$official_date)->first()){
            $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$id_annex)->where('date',$official_date)->first()->iddaily;
        }elseif(DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$id_annex)->where('date',$official_date)->first()){
            $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$id_annex)->where('date',$official_date)->first()->iddaily;
        }elseif(DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$id_annex)->where('date',$official_date)->first()){
            $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$id_annex)->where('date',$official_date)->first()->iddaily;
        }    
        
        $daily_id = DB::table('daily')->where('iddaily',$last_table_infos_getting_iddaily)->first()->code;

        global $diesel_tanks_left;
        global $gasoline_tanks_left;
        global $essence91_tanks_left;
        global $essence95_tanks_left;
        
        if(DB::table('tanks')->where('annex_id',$team_leader_annex)->where('fuel_type','diesel')->get() != '[]'){
            $diesel_tanks_left = DB::table('tanks')->where('annex_id',$team_leader_annex)->where('fuel_type','diesel')->get();
        }
        if(DB::table('tanks')->where('annex_id',$team_leader_annex)->where('fuel_type','gasoline')->get() != '[]'){
            $gasoline_tanks_left = DB::table('tanks')->where('annex_id',$team_leader_annex)->where('fuel_type','gasoline')->get();
        }
        if(DB::table('tanks')->where('annex_id',$team_leader_annex)->where('fuel_type','essence91')->get() != '[]'){
            $essence91_tanks_left = DB::table('tanks')->where('annex_id',$team_leader_annex)->where('fuel_type','essence91')->get();
        }
        if(DB::table('tanks')->where('annex_id',$team_leader_annex)->where('fuel_type','essence95')->get() != '[]'){
            $essence95_tanks_left = DB::table('tanks')->where('annex_id',$team_leader_annex)->where('fuel_type','essence95')->get();
        }

        return view('patrol-show',['diesel_tanks_left'=>$diesel_tanks_left,'gasoline_tanks_left'=>$gasoline_tanks_left,'essence91_tanks_left'=>$essence91_tanks_left,'essence95_tanks_left'=>$essence95_tanks_left,'id'=>$daily_id,'diesel_pomps'=>$get_diesel_pomps,'team_leader_annex'=>$id_annex,'saver_name'=> $get_name_of_saver,'gas_pomps'=>$get_gas_pomps,'last_table'=>$last_table_infos,'fuelprices'=>$fuel_prices],['es91_pomps'=>$get_es91_pomps,'es95_pomps'=>$get_es95_pomps,'comp_id'=>$id_comp,'an_id'=>$id_annex]);
      
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
    public function getpatrolsbydateforsuperuserAllGet($id,$id_an){
        if(isset($_GET['searchquery'])){ //search by patrol dailyid
            if(preg_match("/^[a-zA-Z0-9 ]+$/", $_GET['searchquery'])){
                if(isset($id) && isset($id_an)){
                    if(preg_match('/^[1-9][0-9]*$/',$id) && preg_match('/^[1-9][0-9]*$/',$id_an)){
                        $id_comp = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
                        $id_annex = filter_var($id_an, FILTER_SANITIZE_NUMBER_INT);
                $get_all_unconfirmed_patrols = DB::table('daily')->where('annex_id',$id_an)->where('code',$_GET['searchquery'])->get();
                return view('show-unconfirmed-patrols',['comp_id'=>$id_comp,'an_id'=>$id_annex,'patrols'=>$get_all_unconfirmed_patrols]);
                }
                return redirect("/dashboard/companies/{{$id_comp}}/annexes/{{$id_annex}}/patrols/all");
            }else{

                return redirect("/dashboard/companies");
            }
            } else {
                if(isset($id) && isset($id_an)){
                    if(preg_match('/^[1-9][0-9]*$/',$id) && preg_match('/^[1-9][0-9]*$/',$id_an)){
                        $id_comp = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
                        $id_annex = filter_var($id_an, FILTER_SANITIZE_NUMBER_INT);
                $get_all_unconfirmed_patrols = DB::table('daily')->where('annex_id',$id_an)->get();
                return view('show-unconfirmed-patrols',['comp_id'=>$id_comp,'an_id'=>$id_annex,'patrols'=>$get_all_unconfirmed_patrols]);
                    }
                    return redirect("/dashboard/companies");
                }else{
                    return redirect("/dashboard/companies");
                }
            }
        }elseif(isset($_GET['patrol'])){
            $get_all_unconfirmed_patrols = DB::table('daily')->where('annex_id',$id_an)->get();
            if(preg_match("/^[A-Za-z0-9]+$/", $_GET['patrol'])){
                $official_code_of_patrol = $_GET['patrol'];
                if(isset($id) && isset($id_an)){
                    if(preg_match('/^[1-9][0-9]*$/',$id) && preg_match('/^[1-9][0-9]*$/',$id_an)){
                        $id_comp = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
                        $id_annex = filter_var($id_an, FILTER_SANITIZE_NUMBER_INT);
                        $get_annex_id = $id_annex;
                        $official_date = DB::table('daily')->where('code',$official_code_of_patrol)->first()->timing;
                        if(DB::table('daily')->where('annex_id',$id_an)->where('code',$official_code_of_patrol)->first()){
                            $patrol_id = DB::table('daily')->where('annex_id',$id_an)->where('code',$official_code_of_patrol)->first()->iddaily;
                        }

                        $fuel_prices = DB::table('fuel_price')->get();
    
                if(DB::table('patrol')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->get() != "[]"){
                    
    
                    $get_name_of_saver;

                    if(DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('date',$official_date)->first()){
                        $get_name_of_saver = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('date',$official_date)->first()->name_of_saver;
                    }elseif(DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('date',$official_date)->first()){
                        $get_name_of_saver = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('date',$official_date)->first()->name_of_saver;
                    }elseif(DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('date',$official_date)->first()){
                        $get_name_of_saver = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('date',$official_date)->first()->name_of_saver;
                    }elseif(DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('date',$official_date)->first()){
                        $get_name_of_saver = DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('date',$official_date)->first()->name_of_saver;
                    }
                
                $last_table_infos_getting_iddaily;
                if(DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','gasoline')->where('iddaily',$patrol_id)->where('iddaily',$patrol_id)->first()->iddaily;
                }elseif(DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
                }elseif(DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
                }elseif(DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
                }    
    
                $last_table_infos = DB::table('patrol_summ')->where('iddaily',$last_table_infos_getting_iddaily)->first();
                $get_tanks = DB::table('tanks')->where('annex_id',$get_annex_id)->get();
    
               
                $searchQGasoline = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='gasoline' ");
                $searchQDiesel = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='diesel' ");
        
                 $searchQEssence91 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='essence91'");
                 $searchQEssence95 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='essence95'");

                 if(DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
                }elseif(DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
                }elseif(DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
                }elseif(DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
                }    
                
                $daily_id = DB::table('daily')->where('iddaily',$last_table_infos_getting_iddaily)->first()->code;
                $official_date = DB::table('daily')->where('iddaily',$patrol_id)->first()->timing;
        
        
                return view('patrol-edit',['comp_id'=>$id_comp,'an_id'=>$id_annex,'id'=>$daily_id,'date'=>$official_date,'diesel_pomps'=>$searchQDiesel,'team_leader_annex'=>$get_annex_id,'gas_pomps'=>$searchQGasoline,'fuelprices'=>$fuel_prices],['es91_pomps'=>$searchQEssence91,'es95_pomps'=>$searchQEssence95,'last_table'=>$last_table_infos]);
    
                    }else{
                        return redirect("/dashboard/companies");
                    }
                }else{
                    return redirect("/dashboard/companies");
                }
               
                
    
                }else{
                    die('<center><b>لا يوجد تسجيل بلتاريخ المطلوب</b></center>');
                }
    
            }else{  
                if(isset($id) && isset($id_an)){
                    if(preg_match('/^[1-9][0-9]*$/',$id) && preg_match('/^[1-9][0-9]*$/',$id_an)){
                        $id_comp = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
                        $id_annex = filter_var($id_an, FILTER_SANITIZE_NUMBER_INT);
                        $get_all_unconfirmed_patrols = DB::table('daily')->where('annex_id',$id_an)->get();
                return view('show-unconfirmed-patrols',['comp_id'=>$id_comp,'an_id'=>$id_annex,'patrols'=>$get_all_unconfirmed_patrols]);
                    }else{
                        $id_comp = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
                        $id_annex = filter_var($id_an, FILTER_SANITIZE_NUMBER_INT);
                        return redirect("/dashboard/companies/{{$id_comp}}/annexes/{{$id_annex}}/patrols/all");
                    }
                }else{
                    return redirect("/dashboard/companies/");
                }
            }
            
        }else{ //show all unconfirmed patrols
            if(isset($id) && isset($id_an)){
                if(preg_match('/^[1-9][0-9]*$/',$id) && preg_match('/^[1-9][0-9]*$/',$id_an)){
                    $id_comp = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
                    $id_annex = filter_var($id_an, FILTER_SANITIZE_NUMBER_INT);
                    $get_all_unconfirmed_patrols = DB::table('daily')->where('annex_id',$id_an)->get();
            return view('show-unconfirmed-patrols',['comp_id'=>$id_comp,'an_id'=>$id_annex,'patrols'=>$get_all_unconfirmed_patrols]);
                }else{
                    $id_comp = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
                    $id_annex = filter_var($id_an, FILTER_SANITIZE_NUMBER_INT);
                    return redirect("/dashboard/companies/{{$id_comp}}/annexes/{{$id_annex}}/patrols/all");
                }
            }else{
                return redirect("/dashboard/companies/");
            }
        }
    }

    public function getpatrolsbydateforsuperuserAllPost(Request $request,$id,$id_an){

        $validation = $request->validate([
            'atm' => ['required','digits_between:1,99999999999'],
            'retard' => ['nullable','digits_between:1,99999999999'],
            'repayment' => ['required','digits_between:1,99999999999'],
            'repayment_desc' => ['required','string'],
        ]);

        $atm = $request->input('atm');
        $retard = $request->input('retard');
        $repayment = $request->input('repayment');
        $repayment_desc = $request->input('repayment_desc');

        if(isset($_POST['patrol'])){
            $get_all_unconfirmed_patrols = DB::table('daily')->where('annex_id',$id_an)->get();
            if(preg_match("/^[A-Za-z0-9]+$/", $_POST['patrol'])){
                $official_code_of_patrol = $_POST['patrol'];
                if(DB::table('daily')->where('annex_id',$id_an)->where('code',$official_code_of_patrol)->get() != '[]'){  // check if code exists in companys
                    $patrol_id = DB::table('daily')->where('annex_id',$id_an)->where('code',$official_code_of_patrol)->first()->iddaily;
                    $patrol_date = DB::table('daily')->where('annex_id',$id_an)->where('code',$official_code_of_patrol)->first()->timing;

                    if(isset($id) && isset($id_an)){
                        if(preg_match('/^[1-9][0-9]*$/',$id) && preg_match('/^[1-9][0-9]*$/',$id_an)){
                            $id_comp = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
                            $id_annex = filter_var($id_an, FILTER_SANITIZE_NUMBER_INT);
                            $get_annex_id = $id_annex;
    
                            $fuel_prices = DB::table('fuel_price')->get();
                            $daily_code = $_POST['patrol'];
                            
    
                            
        
                            $total_liters_diesel = 0;

                            $total_liters_gasoline = 0;
                    
                            $total_liters_es91 = 0;
                    
                            $total_liters_es95 = 0;
                               
                    
                            if(DB::table('patrol')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->get() != "[]"){
                                $get_tanks = DB::table('tanks')->where('annex_id',$get_annex_id)->get();
                               
                $searchQGasoline = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='gasoline' ");
                $searchQDiesel = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='diesel' ");
        
                 $searchQEssence91 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='essence91'");
                 $searchQEssence95 = DB::select("SELECT * FROM `tanks` t LEFT JOIN tanks_has_pomps thp ON thp.tank_id=t.`tank_number` WHERE tank_annex_id=$get_annex_id AND annex_id=$get_annex_id AND `fuel_type`='essence95'");
                    
                    
                                if(DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','gasoline')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
                                }elseif(DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','diesel')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
                                }elseif(DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence91')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
                                }elseif(DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()){
                                    $last_table_infos_getting_iddaily = DB::table('patrol')->where('fuel_type','essence95')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->first()->iddaily;
                                }    
                    
                                $daily_id_number = DB::table('daily')->where('iddaily',$last_table_infos_getting_iddaily)->first()->iddaily;
                                
                                $daily_id = DB::table('daily')->where('iddaily',$last_table_infos_getting_iddaily)->first()->code;
                    
                                if($searchQGasoline != '[]'){
                                    foreach($searchQGasoline as $pomp){ //gasoline insert
                                        $pomp_serial = $pomp->pomp_serial;
                                             $pomp_newrecord = filter_var($request->input('g'.$pomp_serial),FILTER_SANITIZE_NUMBER_INT);
                                             $diffence = DB::table('pomps')->where('serial',$pomp_serial)->first()->last_record;
                                             $fuel_price = DB::table('fuel_price')->where('fuel_type','gasoline')->first()->price;
                                             $total_liters_gasoline += $pomp_newrecord*$fuel_price;
                                              //insertGetId
                                            $patrol = DB::table('patrol')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('date',$patrol_date)->where('pomp_serial',$pomp_serial)->where('fuel_type','gasoline')->update([
                                                'new_record'=>$pomp_newrecord,
                                                'diffrenece_in_l'=>($pomp_newrecord-$diffence),
                                                'name_of_saver'=>' تم التعديل عليه من طرف  مدير الموقع',
                                                'fuel_type'=>'gasoline',
                                                'price_of_fuel' => $fuel_price,
                                            ]);
                            
                                            $thp = DB::table('tanks_has_pomps')->where('pomp_serial',$pomp_serial)->where('tank_fuel_type','gasoline')->update([
                                                'last_record' => $pomp_newrecord
                                            ]);
                            
                                           
                                        }
                                }
                    
                                
                                if($searchQDiesel != '[]'){
                                    foreach($searchQDiesel as $pomp){ //diesel insert
                                        $pomp_serial = $pomp->pomp_serial;
                                        $pomp_newrecord = filter_var($request->input('d'.$pomp_serial),FILTER_SANITIZE_NUMBER_INT);
                                             $diffence = DB::table('pomps')->where('serial',$pomp_serial)->first()->last_record;
                                             $fuel_price = DB::table('fuel_price')->where('fuel_type','diesel')->first()->price;
                                
                                             $total_liters_diesel += $pomp_newrecord*$fuel_price;
                                              //insertGetId
                                            $patrol = DB::table('patrol')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('date',$patrol_date)->where('pomp_serial',$pomp_serial)->where('fuel_type','diesel')->update([
                                                'new_record'=>$pomp_newrecord,
                                                'diffrenece_in_l'=>($pomp_newrecord-$diffence),
                                                'name_of_saver'=>' تم التعديل عليه من طرف  مدير الموقع',
                                                'fuel_type'=>'diesel',
                                                'price_of_fuel' => $fuel_price,
                                            ]);
                                
                                            $thp = DB::table('tanks_has_pomps')->where('pomp_serial',$pomp_serial)->where('tank_fuel_type','diesel')->update([
                                                'last_record' => $pomp_newrecord
                                            ]);
                                        }
                                }
                                    
                                if($searchQEssence91 != '[]'){
                                    foreach($searchQEssence91 as $pomp){ //diesel insert
                                        $pomp_serial = $pomp->pomp_serial;
                                        $pomp_newrecord = filter_var($request->input('es91'.$pomp_serial),FILTER_SANITIZE_NUMBER_INT);
                                             $diffence = DB::table('pomps')->where('serial',$pomp_serial)->first()->last_record;
                                             $fuel_price = DB::table('fuel_price')->where('fuel_type','essence91')->first()->price;
                                             $total_liters_es91 += $pomp_newrecord*$fuel_price;
                                              //insertGetId
                                              $patrol = DB::table('patrol')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('date',$patrol_date)->where('pomp_serial',$pomp_serial)->where('fuel_type','essence91')->update([
                                                'new_record'=>$pomp_newrecord,
                                                'diffrenece_in_l'=>($pomp_newrecord-$diffence),
                                                'name_of_saver'=>' تم التعديل عليه من طرف  مدير الموقع',
                                                'fuel_type'=>'essence91',
                                                'price_of_fuel' => $fuel_price,
                                            ]);
                                
                                            $thp = DB::table('tanks_has_pomps')->where('pomp_serial',$pomp_serial)->where('tank_fuel_type','essence91')->update([
                                                'last_record' => $pomp_newrecord
                                            ]);
                                        }
                                }
                           
                        
                                if($searchQEssence95 != '[]'){
                                    foreach($searchQEssence95 as $pomp){ //diesel insert
                                        $pomp_serial = $pomp->pomp_serial;
                                        $pomp_newrecord = filter_var($request->input('es95'.$pomp_serial),FILTER_SANITIZE_NUMBER_INT);
                                             $diffence = DB::table('pomps')->where('serial',$pomp_serial)->first()->last_record;
                                             $fuel_price = DB::table('fuel_price')->where('fuel_type','essence95')->first()->price;
                                             $total_liters_es95 += $pomp_newrecord*$fuel_price;
                                              //insertGetId
                                              $patrol = DB::table('patrol')->where('annex_id',$get_annex_id)->where('iddaily',$patrol_id)->where('date',$patrol_date)->where('pomp_serial',$pomp_serial)->where('fuel_type','essence95')->update([
                                                'new_record'=>$pomp_newrecord,
                                                'diffrenece_in_l'=>($pomp_newrecord-$diffence),
                                                'name_of_saver'=>' تم التعديل عليه من طرف  مدير الموقع',
                                                'fuel_type'=>'essence95',
                                                'price_of_fuel' => $fuel_price,
                                            ]);
                                
                                
                                            $thp = DB::table('tanks_has_pomps')->where('pomp_serial',$pomp_serial)->where('tank_fuel_type','essence95')->update([
                                                'last_record' => $pomp_newrecord
                                            ]);
                                        }
                                }
                        
                                   

                                        $total_cash = ($total_liters_gasoline+$total_liters_diesel+$total_liters_es91+$total_liters_es95) - ($atm+$retard);
                               
                                        DB::table('patrol_summ')->where('iddaily',$daily_id_number)->update([
                                           'atm' => $atm,
                                           'retard' => $retard,
                                           'total_cash' => $total_cash,
                                           'repayment' => $repayment,
                                           'repayment_desc' => $repayment_desc,
                                        ]);
                    
                        }else{
                            return redirect("/dashboard/companies");
                        }           
                        return redirect("/dashboard/companies/$id_comp/annexes/$id_annex/patrols/all?patrol=$official_code_of_patrol");
                    }
                }
                }else{
                    die('<center><h1>لا يمكنك التعديل على ورديات لا تخصك</h1></center>');
                }
               
        }else{
            return redirect("/dashboard/companies/$id_comp/annexes/$id_annex/patrols/all");
        }
    }
}
}
