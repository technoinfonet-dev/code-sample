<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Request;
use DB;

class CheckUserIPLoginAccess
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if(GIVE_IP_ACCESS())
        {
            if(CHECK_IP_ACCESS()){
                if(Auth::guard('admin')->check())
                {
                    \Session::forget('last_tab_id');
                    \Session::forget('last_a_tab_id');
                    $obj = Auth::guard('admin')->user();
                    Auth::guard('admin')->logout();
                    $obj->is_login = '0';
                    $obj->save();
                }
                return redirect('admin.errors.404');
            }
        }
        return $next($request);
    }
}
