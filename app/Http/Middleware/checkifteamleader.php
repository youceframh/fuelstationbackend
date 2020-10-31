<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Auth;


class checkifteamleader
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
        $get_user_type = Auth::user()->typeofuser;
        if($get_user_type != 'annex_TL'){
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
