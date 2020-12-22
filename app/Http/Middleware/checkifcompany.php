<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Support\Facades\Auth;

class checkifcompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) { //checking authentication
            return redirect('/login'); 
        }else{
        $getuseremail = Auth::user()->email;
            $query = DB::table('companies')->where('email',$getuseremail)->first();
            if($query){
               if($query->verified == 3 || $query->verified == 2 || $query->verified == 0){
                return redirect('/submitdocuments');
               }else{
                return $next($request);
               }
        }else{
            return redirect('/dashboard');
           }
    }
  }
}
