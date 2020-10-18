<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Support\Facades\Auth;

class checkifcompanyisverified
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
            $getuseremail = Auth::user()->email;
            $query = DB::table('companies')->where('email',$getuseremail)->first();
            if($query){
               if($query->verified != 1){
                return redirect('/dashboard');
               }
               return $next($request);
        }
        
    }
}
