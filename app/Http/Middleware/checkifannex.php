<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use DB;
class checkifannex
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
            $query = DB::table('annexes')->where('email',$getuseremail)->first();
            if(!$query){
                abort(403, "نحن نتعذر لاكن لا يمكنكم اللجوء الى هذه الصفحة");
        }
        return $next($request);
    }
    }
}
