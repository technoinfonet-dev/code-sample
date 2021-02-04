<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CheckFreePremiumExpiryDate
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
        $user = Auth::guard('business')->user();

        if ($user !=null && $user->is_premium_user == \App\User::CONST_IS_PREMIUM_USER) {

            $checkRecordExit = \App\Models\UsedCouponCode::where('user_id',$user->id)->where('status','1')->first();

            if ($checkRecordExit !=null) {
                    
                 $crrentDate = strtotime(date('Y-m-d',strtotime(Carbon::now()->toDateTimeString())));
                 $expiryDate = strtotime(date('Y-m-d',strtotime($checkRecordExit->expirty_date)));

                 if ($crrentDate > $expiryDate) {

                    $updateData = \App\Models\UsedCouponCode::where('user_id',$user->id)->where('status','1')->first();       
                    $updateData->status = '0';
                    $updateData->save();

                    $userData = \App\User::select(SELECT_USER_FIELD())->find($user->id);
                    $userData->is_premium_user = \App\User::CONST_IS_FREE_USER;
                    $userData->save();

                    $data = GET_EMAIL_TEMPLATE('premium_membership_expire_mail_to_user');
                    $template = CHANGESITETEXT($data->template);
                    $subject  = $data->subject;
                    $sender   = $data->from_email;
                    $email_body = str_replace(array('###FIRST_NAME###','###SITE_URL###'),
                        array($user->display_name,API_GET_HOME_PAGE_URL()), $template);
                    SENDMAIL($email_body,$sender,$subject,$user->email);

                    $data = GET_EMAIL_TEMPLATE('premium_membership_expire_mail_to_user_admin');
                    $template = CHANGESITETEXT($data->template);
                    $subject  = str_replace('###FIRST_NAME###', $user->display_name, $data->subject);
                    $sender   = $data->from_email;
                    $email_body = str_replace(array('###FIRST_NAME###','###SITE_URL###'),
                        array($user->display_name,API_GET_HOME_PAGE_URL()), $template);
                    SENDMAIL($email_body,$sender,$subject,$user->email);
                }
            }
        }

        return $next($request);
    }
}
