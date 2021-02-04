<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class CheckAdminStatus
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
        $user = \Auth::guard('admin')->user();
        if ($user->status == '0') {

            $message = trans('lang_data.account_deactivated_contact_admin');
            $type = "error";
            return app('Modules\Admin\Http\Controllers\LoginController')->getLogout($message,$type);
        }
        
        return $next($request);
    }
}
