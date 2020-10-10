<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class profilepic extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(){
        return view('dashboard-profile',['pic' => Auth::user()->picture ]);
    }

    public function post(Request $request){

        $validate = $request->validate([
            'profilepic' => ['required','file','max:4096'],
        ]);

        $file = $request->profilepic;
       $imgid = uniqid("picture");
     $filemime = $file->extension();

       $newpth =  $file->move(storage_path('/app/public'),$imgid.".".$filemime);
       $vv = $imgid.".".$filemime;
        $insert =  DB::table('users')->where('id',Auth::user()->id)->update(['picture' => "$vv"]);

        

        if($insert){
            return view('dashboard-profile',['success' => 'تم التغيير بنجاح']);
        }else{
            return view('dashboard-profile',['success' => 'لا يمكن التغيير حاليا حاول لاحقا']);
        }
    }

}
