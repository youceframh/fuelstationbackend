<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class showannexesinfos extends Controller
{
    public function __construct(){
        $this->middleware('company.status');
    }
    public function get($id){
        if(preg_match('/^[1-9][0-9]*$/',$id)){
            $ids = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $get_annex = DB::table('annexes')->where('idannexes',$ids)->get();
            return view ('show-annex-infos',['annex'=>json_decode($get_annex,true)]);

        }else{
            return redirect('/dashboard/companies');
        }
           
    }
    public function post(Request $request,$id){
        
        if(preg_match('/^[1-9][0-9]*$/',$id)){
            $ids = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $typeofreq = $request->input('type');
            $get_company = DB::table('companies')->where('idcompanies',$ids)->get();
            if(isset($_GET['type'])){
                
            }
        }else{
            return redirect('/dashboard/companies');
        }
       
    }
}
