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
            return redirect('/dashboard/annexes');
        }
           
    }
    public function post(Request $request,$id){
        
        if(preg_match('/^[1-9][0-9]*$/',$id)){
            $ids = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $get_company = DB::table('annexes')->where('idannexes',$ids)->get();
            if($get_company !== '[]'){
                if(isset($_POST['type'])){
                    $get_company = DB::table('annexes')->where('idannexes',$ids)->delete();
                    return redirect('/dashboard/annexes');
                }else{
                    return redirect("/dashboard/annexes/$id");
                }
            }else{
                return redirect('/dashboard/annexes');
            }
           
        }else{
            return redirect('/dashboard/companies');
        }
       
    }
}
