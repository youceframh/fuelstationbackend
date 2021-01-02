<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\companies_files;

class submitdocuments extends Controller
{
    public function __construct()
    {
        $this->middleware('company.isverified');
        
}

    public function get(){
        return view('submitdocuments');
    }

    public function post(Request $request){
        //verification of inputs and their types
      $verification =  $request->validate([
            'file' => ['required', 'file', 'max:8096','mimes:zip'],
        ]);
        //if verification goes well 
           if($verification){
               //make inputs inside vars
               $file = $request->file;
               $name = Auth::user()->email.date('y-m-d');
            $file_content = $file->getRealPath();
            $file = file_get_contents($file_content);

            try{
                $insertDB = companies_files::create(array(
                    'name' => $name,
                    'type' => 'zip',
                    'content' => $file,
                    'size' => $request->file->getSize(),
                    'company_id' => Auth::user()->id,
                ));

                $insertDBt = DB::table('companies')->where('email',Auth::user()->email)->update([
                    'verified' => 2
                ]);

            }catch (\Illuminate\Database\QueryException $e){
               die('حصل خطا حاول مجددا');
            }
            
            if($insertDB){
                return view('submitdocuments',['success' => 'سوف يتم مراجعة ملفاتك']);
       }else{
           //else returning error
           return view('submitdocuments',['failed' => 'لا يمكن تسجيل حاليا حاول لاحقا']);
       }
               //don't forget to add password
               //checking the status
           }

    }
}
