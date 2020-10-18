<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Support\Facades\Auth;
use Exception;


class authverified
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
        if (!Auth::check()) {
            return redirect('/login');
        }else{
            $getusertype = Auth::user()->is_admin;
            switch($getusertype){
                case 2:
                    $getuseremail = Auth::user()->email;
                    $query = DB::table('companies')->where('email',$getuseremail)->first();
                    if($query){
                        switch($query->verified){
                            case 2 :
                                abort(403, "للجوء الى هذه الصفحة يجب ان يتم التحقق من ملقات تعريف الشركة");
                            break;
                            case 3 :
                                abort(403, "للجوء الى هذه الصفحة يجب ان يتم التحقق من ملقات تعريف الشركة");
                            break;
                            case 0 :
                                abort(403, "للجوء الى هذه الصفحة يجب ان يتم التحقق من ملقات تعريف الشركة");
                            break;
                            case 1 : 
                                return $next($request);
                            break;
                        }
                    }

            }
            return $next($request);
        }
        
    }
}
