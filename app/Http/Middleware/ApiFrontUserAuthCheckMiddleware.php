<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class ApiFrontUserAuthCheckMiddleware
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
    public function handle($request, Closure $next, $guard = null)
    {

        if (auth('webService')->check()) {
            $user = auth('webService')->user();
            if ($user->user_type != \App\Models\User::FRONT_USER_TYPE) {
                
                return app('App\Http\Controllers\Api\CommonApiController')->sendResponse(401,(object)[],trans('lang_data.unauthorized_access_label'));    
            }
        }

        return $next($request);
    }
}
