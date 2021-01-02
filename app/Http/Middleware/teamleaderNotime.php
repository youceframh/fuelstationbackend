<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class teamleaderNotime
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
            $get_user_type = Auth::user()->typeofuser;

            if(!$get_user_type == 'annex_TL'){
                return redirect('/dashboard');
            }
        return $next($request);
        }
    }
}
