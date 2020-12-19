<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class patrolsee
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
        if(Auth::check()){
            if((Auth::user()->typeofuser == 'delegate') || (Auth::user()->typeofuser == 'annex_TL')){
                return $next($request);
            }else{
                return redirect('/dashboard');
            }
           
        }
       
    }
}
