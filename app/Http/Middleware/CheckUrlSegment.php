<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckUrlSegment
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
        $firstSegment = GETSEGMENT(1);
        $country = \App\Models\Country::select('sortname','status')->where('status','1')->pluck('sortname')->toArray();

        $admin_segment = \Request::segment(2);
        /* Detect IP and navigate on corrent webpage */
        $ip=$_SERVER['REMOTE_ADDR'];
        $location = json_decode(@file_get_contents("http://ipinfo.io/".$ip."/json"));
        $Loc_code = isset($location->country) && !empty($location->country) ? $location->country : "";
        $Loc_code = isset($location['countryCode']) && !empty($location['countryCode']) ? $location['countryCode'] : "";*/
        if(isset($Loc_code) && !empty($Loc_code))
        {
            $Loc_code = isset($Loc_code) && $Loc_code == 'ZA' ? "SF" : $Loc_code;
            if(in_array(strtolower($Loc_code), $country))
            {
                $code = strtolower($Loc_code);
            }
            else
            {
                $code = env('DEFAULT_COUNTRY');
            }
        }
        else
        {
            $code = env('DEFAULT_COUNTRY');
        }
        /* End detect IP and navigate on corrent webpage */
        if ($admin_segment == ADMIN_KEYWORD() && !in_array($firstSegment, $country)) {
            return \Redirect::To('/'.$code.'/'.ADMIN_KEYWORD().'/404');
        }
        elseif ($firstSegment =='' || $firstSegment == null) {
            return \Redirect::To('/'.$code);

        }elseif ($firstSegment !="" && $firstSegment !=null && !in_array($firstSegment, $country)) {
                
            return \Redirect::To('/'.$code.'/404');
        }

        return $next($request);
    }
}
