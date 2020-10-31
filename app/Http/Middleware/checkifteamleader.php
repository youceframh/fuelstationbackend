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
        if(Auth::check()){
            $get_user_type = Auth::user()->typeofuser;
            $get_user_email= Auth::user()->email;
            $get_user_time = DB::table('employees')->where('email',$get_user_email)->first();
            $employee_starttime = date('H:i',strtotime($get_user_time->patrol_time_start));
            $employee_endtime = date('H:i',strtotime($get_user_time->patrol_time_end));
    
            if($get_user_type == 'annex_TL'){
                if(date('H:i') >= $employee_endtime) {
                    return redirect('/patrol/show');
                  }elseif(date('H:i') < $employee_starttime){
                    return redirect('/patrol/show');
                  }
                  return $next($request);
            }else{
                return redirect('/dashboard');
            }
        }else{
            return redirect('/login');
        }
    
    }
}
