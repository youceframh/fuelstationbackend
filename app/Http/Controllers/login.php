<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class login extends Controller
{
    public function loginshow(Request $request){ // function for returning login html page
        $loggedin = $request->session()->get('loggedin');
        if(isset($loggedin)){
         return redirect('dashboard');
        }else{
            $users = DB::table('users')->get();
            return view('login', ['users' => $users]);
        }
       
    }
    public function loginverify(Request $request){ // verifying login information
        //verify inputs 
        $loggedin = $request->session()->get('loggedin');
        if(isset($loggedin)){
            return redirect('dashboard');
        }else{
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            
                if($request){
                    $email = $request->input('email');
                    $pass = $request->input('password');
    
                    if($user = DB::table('users')->where('email',$email)->first()){
                        if($user->password === $pass){
                            
                            $insertsession = DB::insert("INSERT INTO `sessions` (`sessionid`, `sessionusername`, `sessionemail`, `sessionpicture`) VALUES (null, '$user->username', '$user->email', 'base64')");

                            $sessionidindb = DB::table('sessions')->where('sessionemail',$email)->first();

                            $userinfos = array('loggedin'=> true,'sessionid'=> $sessionidindb->sessionid,'sessionusername'=> $sessionidindb->sessionusername);

                            $request->session()->put('loggedin',$userinfos);

                            return redirect('dashboard');

                        }else{
                            return view('login', ['loginerror' => "email or password is wrong"]);
                        }
                    }else{
                        return view('login', ['loginerror' => "email or password is wrong"]);
                    }
                    
    
                    
                }
           
        }
        }
      
}
