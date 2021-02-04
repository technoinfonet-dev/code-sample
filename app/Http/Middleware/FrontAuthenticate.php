<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class FrontAuthenticate
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
        if (!Auth::check()) {
            if ($request->ajax()) {
                return response(trans('lang_data.unauthorized_access_label'), 401);
            } else {
                flash(trans('lang_data.sess_you_must_login'))->error()->important();
                return redirect()->route("front.login");
            }
        }
        else
        {
            $user = Auth::guard()->user();
            if($user->user_type == "1")
            {
                $message = trans('lang_data.you_dont_have_access');
                $type = "error";
                return app('App\Http\Controllers\AccountController')->getLogout($message,$type);
            }
            else
            {
                return $next($request);
            }
        }
        return $next($request);
    }
}
