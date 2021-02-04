<?php

namespace App\Models;

use App\Models\Inquiry;
use Crypt;
use Illuminate\Database\Eloquent\Model;
use Mail;
use Validator;
use Yajra\Datatables\Datatables;

class Inquiry extends Model
{
    protected $table = 'inquiries';

    protected $guarded = ['id'];

    const STATUS_ACTIVE   = 1;
    const STATUS_INACTIVE = 0;

    /**
     * Save Contact Us Records
     * @author Kunj
     * @return void
     * @author
     **/
    public function saveFrontContactUs($request)
    {
        $errors = "";
        $input  = $request->all();
        $obj    = new self;

        $obj->country_id       = GET_COUNTRY_ID_BASE_ON_SEGMENT(GETSEGMENT(1));
        $obj->name             = $request->name;
        $obj->email            = $request->email;
        $obj->phone            = $request->phone;
        $obj->company_name     = $request->company_name;
        $obj->long_description = $request->long_description;
        $obj->save();

        $country = \App\Models\Country::where('sortname',GETSEGMENT(1))->first();

        ### Send mail to user
        $data = GET_EMAIL_TEMPLATE('contact_us');
        $template   = $data->template;
        $subject    = CHANGESITETEXT($data->subject);
        $sender     = $data->from_email;
        $email_body = str_replace(array('###NAME###', '###EMAIL###', '###CONTACT_NO###', '###COMPANY_NAME###', '###SITE_URL###', '###LONGMESSAGE###','###COUNTRY###'), array($request->name, $request->email, $request->phone, $request->company_name, FRONT_URL(), $request->long_description, $country->name), $template);
        SENDMAIL($email_body,$sender,$subject,$obj->email);

        ### Send email to admin
        $data = GET_EMAIL_TEMPLATE('contact_us_admin');
        $template   = $data->template;
        $subject    = str_replace('###NAME###', $request->name, CHANGESITETEXT($data->subject));
        $sender     = $data->from_email;
        $email_body = str_replace(array('###NAME###', '###EMAIL###', '###CONTACT_NO###', '###COMPANY_NAME###', '###SITE_URL###', '###LONGMESSAGE###','###COUNTRY###'), array($request->name, $request->email, $request->phone, $request->company_name, FRONT_URL(), $request->long_description, $country->name), $template);
        SENDMAIL($email_body,$sender,$subject,SITE_INFO('email'));

        
        $msg = trans('lang_data.thank_you_contact_us');
        flash($msg)->success()->important();
        return response()->json(['success' => 1, 'msg' => $msg, 'errors' => ""]);
    }
}
