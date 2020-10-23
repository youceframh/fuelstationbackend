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
            return view ('show-company-infos',['company'=>json_decode($get_company,true)]);

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
}
