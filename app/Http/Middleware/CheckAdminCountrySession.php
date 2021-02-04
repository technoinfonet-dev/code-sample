<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class CheckAdminCountrySession
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
        $firstSegment = GETSEGMENT(1);
        $countryId = GET_COUNTRY_ID_BASE_ON_SEGMENT($firstSegment);
        $admin = "admin";
        $user = \Auth::guard($admin)->user();
        if ($user) {

            if ($countryId != null && $countryId !="" && $user->country_id != $countryId) {

                $message = trans('lang_data.you_dont_have_access');
                $type = "error";
                return app('Modules\Admin\Http\Controllers\LoginController')->getLogout($message,$type);

            }
        }

        return $next($request);
    }
}
