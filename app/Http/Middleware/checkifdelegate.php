<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checkifdelegate
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
            if(!Auth::user()->typeofuser == 'delegate'){
                return redirect('/dashboard');
            }
            return $next($request);
        }else{
            return redirect('/login');
        }
        
    }
}
