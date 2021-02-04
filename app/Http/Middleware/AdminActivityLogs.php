<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Request;
use DB;

class AdminActivityLogs
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
        if (\Auth::guard('admin')->check())
        {
            if(Request::method() == "DELETE") {
                $recordId = \Crypt::decrypt(Request::segment(5));
            } else if(Request::method() == "PUT") {
                $recordId = \Crypt::decrypt(Request::segment(5));
            } else {
                if(Request::segment(4) == "status_change"){
                    $recordId = \Crypt::decrypt(Request::segment(5));
                } else {
                    $recordId = NULL;
                }
            }

            if(Request::segment(3) != "activity_logs" && Request::segment(3) != "view_generated_report"){
                $logs = new \App\Models\ActivityLog;
                $logs->saveActivityLogs($request,$recordId); // For storing Activity Logs
            }
                
        }
        return $next($request);
    }
}
