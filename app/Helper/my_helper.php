<?php
	use Illuminate\Support\Facades\Input;
	/**
     * This function is used for get front request url
     * @author Hirak
     * @reviewer
     */
	function FRONT_REQUEST_URL()
	{
		if(Request::segment(1) && Request::segment(1)!="")
		{
			return trim(Request::segment(1));
		}
		else
		{
			return "";
		}
	}
	/**
     * This function is used for get admin request url
     * @author Hirak
     * @reviewer
     */
	function ADMIN_REQUEST_URL()
	{
		return trim(Request::segment(2));
	}
	/**
     * This function is used for get minimum char limit
     * @author Hirak
     * @reviewer
     */
	function MIN_CHARACTER_LIMIT()
	{
		return '3';
	}
	/**
     * This function is used for get maximum char limit
     * @author Hirak
     * @reviewer
     */
	function MAX_CHARACTER_LIMIT()
	{
		return '250';
	}
	/**
     * This function is used for generate csrf token
     * @author Hirak
     * @reviewer
     */
	function GENERATE_CSRF_TOKEN()
	{
		return "<input type='hidden' name='_token' value='".csrf_token()."'>";
	}
	/**
     * This function is used for generate token
     * @author Hirak
     * @reviewer
     */
	function GENERATE_TOKEN()
	{
		$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$token = '';
		for ($i = 0; $i < 6; $i++)
		{
			$token .= $characters[rand(0, strlen($characters) - 1)];
		}
		$token = time().$token.time();
		return $token;
	}
	/**
     * This function is used for upload file
     * @author Hirak
	 * @param $request
	 * @param $file
	 * @param $path
     * @reviewer
     */
	function upload_file($request,$file,$path,$params=array())
	{	
		if (Input::hasFile($file))
		{	
			$type = $request->file($file)->getClientMimeType();
			$extension = "";
		    if ($type == "image/jpeg") {
		        $extension = ".jpeg";
		    } else if ($type == "image/jpg") {
		        $extension = ".jpg";
		    } else if ($type == "image/png") {
		        $extension = ".png";
		    }

			$filename = time()."_".str_replace([" ","(",")"], ["","",""], $request->file($file)->getClientOriginalName());
			if(!file_exists($path))
			{
				mkdir($path,0777,true);
			}
			$request->file($file)->move(
				$path, $filename
			);
			// resizeTheImage(rtrim($path,'/').'/'.$filename,$params);
			if ($extension == ".jpeg" || $extension == ".jpg") {
				
	            $image = imagecreatefromjpeg($path.''.$filename);

	            if (function_exists('exif_read_data')) {
		            $exif = @exif_read_data($path.''.$filename);
		        }

	            if (!isset($exif['Orientation']) && empty($exif['Orientation']))
	            {
	            	resizeTheImage(rtrim($path,'/').'/'.$filename,$params);
	                return $filename;
	            }

	            switch ($exif['Orientation'])
	            {
	                case 3:
	                    $image = imagerotate($image, 180, 0);
	                    break;
	                case 6:
	                    $image = imagerotate($image, - 90, 0);
	                    break;
	                case 8:
	                    $image = imagerotate($image, 90, 0);
	                    break;
	            }

	            imagejpeg($image, $path.''.$filename);
	        }
            resizeTheImage(rtrim($path,'/').'/'.$filename,$params);
        	return $filename;
		}
		else
		{
			return '';
		}
	}
	/**
     * This function is used for get site information
     * @author Hirak
	 * @param $field
     * @reviewer
     */
	function SITE_INFO($field=null)
	{	
		return \App\Models\Setting::siteInfo($field);

	}

	/**
     * This function is used for get user information
     * @author Hirak
	 * @param $field
	 * @param $profile_type For employees if passed parent_profile than get profile of parent agent if url is not in whitelisted list
	 *                      For employees if passed compulsory_parent_profile than phofile of parent agent compulsory
     * @reviewer
     */
	function USER_INFO($field=null,$profile_type='parent_profile')
	{
		if(Auth::check())
		{
			$user_obj = Auth::user();
			if(isset($field) && !empty($field))
			{
				return $user_obj->$field;
			}
			else
			{
				return $user_obj;
			}
		}
		else
		{
			return false;
		}

	}
	
	/**
     * This function is used for convert string to word
     * @author Hirak
	 * @param $str
     * @reviewer
     */
	function STR_TO_WORD($str)
	{
		return ucwords(str_replace("_"," ",$str));
	}
	//for "-" to " "
	function STR_TO_WORD_FOR_URL($slug)
	{
		return ucwords(str_replace("-"," ",$slug));
	}

	/**
     * This function is used for get system date format in js
     * @author Hirak
     * @reviewer
     */
	function SYSTEM_DATE_FORMAT_JS()
	{
		return 'dd-mm-yy';
	}
	
	/**
     * This function is used for get system date format in sql
     * @author Hirak
     * @reviewer
     */
	function SYSTEM_DATE_FORMAT_SQL()
	{
		return '%d-%m-%Y';
	}

	/**
     * This function is used for get google map api key
     * @author Hirak
     * @reviewer
     */
	function GOOGLE_MAP_API_KEY()
	{
		return false;
	}
	
	/**
     * This function is used for create user name from email for front
     * @author Hirak
	 * @param $email
     * @reviewer
     */
	function GENERATE_USERNAME($email=null)
	{
		$username = GENERATE_TOKEN();
		if(isset($email) && !empty($email))
		{
			$arr = explode('@', $email);
			if(isset($arr[0]) && !empty($arr[0]))
			{
				$username = $arr[0];
			}
		}
		return $username;
	}
	
	/**
	 * Function for print data on screen and exit with flag
	 * @author : Parth
	 * @reviewer
	 */
    function pre($data, $isExit = false) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        if (!$isExit) {
            exit;
        }

    }
	/**
	 * This function is used to get the client IP Address
	 * @author  Hirak
	 */
	function get_client_ip() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	/**
	 * Generate latitude longitude from the area section
	 * @param  string $main_location_str
	 * @author  Hirak
	 */
	if(!function_exists('__CRM_GENERATE_LAT_LONG_FROM_AREA_STR'))
	{
		function __CRM_GENERATE_LAT_LONG_FROM_AREA_STR($main_location_str) {
			$r_a = array();
			$location_str = str_replace([", "," "],["+","+"],$main_location_str);
			
			$i=0;
			if(!empty($location_str))
			{
				do{
					$geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$location_str.'&sensor=false&key=AIzaSyCLEN1SiIoIfUaWMeo83ESs5nnpC4Aft0k');
					$output= json_decode($geocode);
					$i++;
				}while((!isset($output->results[0]->geometry->location->lat) 
					|| empty($output->results[0]->geometry->location->lat)) && $i<10
				);
			}
			if(isset($output->results[0]->geometry->location->lat) && !empty($output->results[0]->geometry->location->lat))
			{
		        $r_a['latitude'] = $output->results[0]->geometry->location->lat;
			}
			else
			{
				$r_a['latitude'] = "";
			}
			if(isset($output->results[0]->geometry->location->lng) && !empty($output->results[0]->geometry->location->lng))
			{
		        $r_a['longitude'] = $output->results[0]->geometry->location->lng;
			}
			else
			{
				$r_a['longitude'] = "";
			}
			return $r_a;
		}
	}

	/**
	 * This function is used to get country id based on segment
	 */
	function GET_COUNTRY_ID_BASE_ON_SEGMENT($segment){
		$counrtyId = \Config::get('constantCountry')->id;
		return $counrtyId;
	}

	/**
	 * Convert Field to Decrypt
	 */
	function CONVERT_FIELD_TO_DECRYPT($field) {

		$decryptField = \DB::raw("CONVERT(AES_DECRYPT(".$field.",'".env('APP_AESENCRYPT_KEY')."') using utf8) as ".$field."");
		return $decryptField;
	}	

	/**
	 * Job Timings Array
	 */
	function JOBTIMINGS()
	{
		return array(
			"1" => trans('lang_data.urgently'),
			"2" => trans('lang_data.within_2_days'),
			"3" => trans('lang_data.within_2_weeks'),
			"4" => trans('lang_data.within_2_months'),
			"5" => trans('lang_data.2_months_plus'),
			"6" => trans('lang_data.i_am_flexible_on_start_date')
		);
	}

	/**
	 * Job Budget Array
	 */
	function BUDGET()
	{
		return array(trans('lang_data.not_defined'),trans('lang_data.under_250'),trans('lang_data.under_500'),trans('lang_data.under_1000'),trans('lang_data.under_2000'),trans('lang_data.under_4000'),trans('lang_data.under_8000'),trans('lang_data.under_15000'),trans('lang_data.under_30000'),trans('lang_data.over_30000'));
	}

	/**
	 * Job Timing Stage Array
	 */
	function TIMING_STAGE()
	{
		return array(
			"1" => trans('lang_data.i_am_ready_to_hire'),
			"2" => trans('lang_data.i_am_planning_and_budgeting'),
			"3" => trans('lang_data.form_other')
		);
	}

	/**
	 * Job rating message Array
	 */
	function RATING_MESSAGE()
	{
		return array(
			"1" => trans('lang_data.terrible'),
			"2" => trans('lang_data.poor'),
			"3" => trans('lang_data.average'),
			"4" => trans('lang_data.very_good'),
			"5" => trans('lang_data.outstanding')
		);
	}

	/**
	 * Job status Array
	 */
	function JOB_STATUS()
	{
		return array(
			""  => trans('lang_data.select_job_status'), 
			"1" => trans('lang_data.waiting_for_quotes'), 
			"2" => trans('lang_data.service_provider_found'),
			"3" => trans('lang_data.withdrawn'),
			"4" => trans('lang_data.work_in_progress'),
			"5" => trans('lang_data.partially_completed'), 
			"6" => trans('lang_data.completed')
		);
	}

	/**
	 * [Convert_String This function is used to convert string if null then it returns blank value]
	 * @param array $Array [description]
	 */
	function Convert_String($Array = array())
	{
	    $tempArr = [];
	    if (!empty($Array)) {
	        foreach ($Array as $key => $value) {
	            if (is_array($value)) {
	                $tempArr[$key] = Convert_String($value);
	            } else {
	                if (is_null($value)) {
	                    $tempArr[$key] = "";
	                } else {
	                    $tempArr[$key] = $value;
	                }
	            }
	        }
	    }
	    return $tempArr;
	}

	/**
	 * This function is used to check request whether it is Web or API request
	 */
	function CHECK_API_REQUEST_OR_WEB()
	{
        if (\Request::segment(1) == API_NAME_KEYWORD()) {
          	$checkApiCall = true;  
        }else{
            $checkApiCall = false;
        }
        return $checkApiCall;
	}

	/**
	 * [GET_COUNTRY_CODE_FROM_URL This function is used to get country code]
	 * @param [type] $checkRequest [description]
	 * @author Chirag Ghevariya
	 */
	function GET_COUNTRY_CODE_FROM_URL($checkRequest){
		
		if ($checkRequest) {
			$url = GETSEGMENT(2);
        }else{
            $url = GETSEGMENT(1);
        }
        return $url;
	}

	/**
	 * This function is used to get front business store customer account verification url
	 * @param  [type]     $userId    [id of the user]
	 * @param  [type]     $tokenData [token]
	 */
	function SAVE_FRONT_BUSINESS_STORE_CUSTOME_MAIL_URL($userId,$tokenData){

		return url('/').'/'.GETSEGMENT(2).'/'.VERIFY_BUSINESS_USER_URL().Crypt::encrypt($userId).'/'.$tokenData;
	}

	/**
	 * This function is used to get forgot user password link
	 * @param  [type]     $token [token]
	 */
	function FORGOT_USER_PASSWORD_LINK($token){

		return url('/').'/'.GETSEGMENT(2).'/'.VERIFY_FRONT_USER_FORGOT_PASS_URL().''.Crypt::encrypt($token);
	}

	/**
	 * This function is used to get front post register link
	 * @param  [type]     $id    [id of the user]
	 * @param  [type]     $token [token]
	 */
	function FRONT_POST_REGISTER_LINK($id,$token){

		return url('/').'/'.GETSEGMENT(2).'/'.VERIFY_FRONT_USER_URL().Crypt::encrypt($id).'/'.$token;
	}

	/**
	 * This function is used to get business user forgot password link
	 * @param  [type]     $token [token]
	 */
	function BUSINESS_USER_FORGOT_PASSWORD_LINK($token){

		return url('/').'/'.GETSEGMENT(2).'/'.VERIFY_BUSINESS_USER_FORGOT_PASS_URL().''.Crypt::encrypt($token);
	}	

	/**
	 * This function is used to get business store detail url
	 * @param  [type]     $sortName [sort name of the country]
	 * @param  [type]     $slug     [slug of the business store]
	 */
	function BUSINESS_STORE_DETAIL_URL($sortName,$slug){

		return url('/').'/'.$sortName.'/stores/'.$slug;
	}

	/**
	 * This function is used to get write review slug url
	 * @author Kirtan Prajapati
	 * @date   2020-03-17
	 * @param  [type]     $sortName [sort name of the country]
	 * @param  [type]     $slug     [slug of the business store]
	 */
	function GET_COUNTRY_WRITE_REVIEW_SLUG_URL($sortName,$slug){

		return url('/').'/'.$sortName.'/write-review/'.$slug;
	}	

	/**
	 * This function is used to get email template
	 * @param  [type]     $title [title of the template]
	 */
	function GET_EMAIL_TEMPLATE($title){

		$data = \App\Models\Template::where('status',\App\Models\Template::STATUS_ACTIVE)
					->where('title',$title)
					->first();
		return $data;			
	}
	
	/**
	 * This function is used to get category show count
	 */
	function GET_CATGEORY_SHOW_COUNT()
	{
		return 8;
	}

	/**
     * This function is used for upload multiple file
     * @author Hirak
	 * @param $request
	 * @param $file
	 * @param $path
	 * @param $module_name
     * @reviewer
     */
	function upload_for_multiple_file($request,$file,$path,$params=array())
	{
		$allowedMimeTypes = ['image/jpeg','image/png','image/jpg'];
		$type = $request->getClientMimeType();
		$extension="";
		if($type=="image/jpeg")
		{
			$extension = ".jpeg";
		}
		else if($type=="image/jpg")
		{
			$extension = ".jpg";
		}
		else if($type=="image/png")
		{
			$extension = ".png";
		}
		$filename = time().uniqid()."_business_store_photos".$extension;
		resizeTheImage(rtrim($path,'/').'/'.$filename,$params);
		if(in_array($request->getClientMimeType(), $allowedMimeTypes) ){
			$request->move(
				$path, $filename
			);

			 if ($extension == ".jpeg" || $extension == ".jpg") {
            
	            $image = imagecreatefromjpeg($path.''.$filename);
	            
	            if (function_exists('exif_read_data')) {
		            $exif = @exif_read_data($path.''.$filename);
		        }

	            if (!isset($exif['Orientation']) && empty($exif['Orientation']))
	            {
	                return $filename;
	            }

	            switch ($exif['Orientation'])
	            {
	                case 3:
	                    $image = imagerotate($image, 180, 0);
	                    break;
	                case 6:
	                    $image = imagerotate($image, - 90, 0);
	                    break;
	                case 8:
	                    $image = imagerotate($image, 90, 0);
	                    break;
	            }

	            imagejpeg($image, $path.''.$filename);
				//resizeTheImage(rtrim($path,'/').'/'.$filename,$params);
	            return $filename;

	        }else{

				//resizeTheImage(rtrim($path,'/').'/'.$filename,$params);
	            return $filename;
	        }

			return $filename;
		}
		else
		{
			return "";
		}
	}

	/**
	 * Make slug from string
	 * @param [type] $title
	 * @author Bhargav Upadhyay
	 */
	function GENERATESLUGONTITLE($title)
	{
        if(is_arabic($title))
        {
            return urldecode(stringToURL($title));
        }
        else
        {
            return strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $title))))), '-'));
        }
		
	}

	/**
	 * Make business slug from string
	 * @param [type] $title
	 * @author Bhargav Upadhyay
	 */
	function GENERATEBUSINESSSLUG($title,$cityslug,$email=NULL)
	{
        if(is_arabic($title))
        {
            $emailArr = explode('@', $email);
            return GENERATESLUGONTITLE($emailArr[0]).'-'.$cityslug;
        }
        else
        {
            return GENERATESLUGONTITLE($title).'-'.$cityslug;
        }
	}


	/**
	 * Send mail common function
	 * @param [type] $email_body string
	 * @param [type] $data 		 array
	 * @param [type] $subject 	 string
	 * @param [type] $bs_email 	 string
	 * @author Bhargav Upadhyay
	 */
	function SENDMAIL($email_body,$data,$subject,$bs_email,$file="")
	{
		if(env('LOCALORLIVE') == "local"){
            if(env('MAIL_SEND') == "true"){
                if(env('MAIL_TYPE') == "test")
                {
                    \Mail::send('emails.mail_template', ['email_body' => $email_body], function ($message) use ($data, $subject, $bs_email, $file) {
                        $message->to(env('MAIL_DEBUG'))->subject($subject);
                        if(!empty($file))
                        {
                        	$message->attach($file);
                        }
                        $message->from($data, SITE_INFO('name'));
                    });
                } else {
                    \Mail::send('emails.mail_template', ['email_body' => $email_body], function ($message) use ($data, $subject, $bs_email, $file) {
                        $message->to($bs_email)->subject($subject);
                        if(!empty($file))
                        {
                        	$message->attach($file);
                        }
                        $message->from($data, SITE_INFO('name'));
                    });
                }
            }
        } else {
            
            \Mail::send('emails.mail_template', ['email_body' => $email_body], function ($message) use ($data, $subject, $bs_email, $file) {
                $message->to($bs_email)->subject($subject);
                if(!empty($file))
                {
                	$message->attach($file);
                }
                $message->from($data, SITE_INFO('name'));
            });
        }
	}

	/**
	 * Privacy policy url
	 * @author Bhargav Upadhyay
	 */
	function PRIVACY_POLICY_URL()
	{
		return url('/').'/'.GETSEGMENT(1).'/privacy-policy';
	}

	/**
	 * Condition of user url
	 * @author Bhargav Upadhyay
	 */
	function CONDITIONS_OF_USE()
	{
		return url('/').'/'.GETSEGMENT(1).'/conditions-of-use';
	}

	/**
	 * Image title max length
	 * @author Bhargav Upadhyay
	 */
	function MAXIMAGETITLELENGTH()
	{
		return "25";
	}

	/**
	 * Set admin logout time
	 * @author Bhargav Upadhyay
	 */
	function ADMINLOGOUTTIME()
	{
		return "1800"; // 30 (minutes) * 60 (1 minute in second) = 1800
	}

	/**
	 * Show number of blogs in page
	 * @author Bhargav Upadhyay
	 */
	function SHOWBLOGNUMBER()
	{
		return "6";
	}

	/**
	 * Fix length
	 * @author Bhargav Upadhyay
	 */
	function FIXLENGTH($title,$char)
	{
		return str_limit($title,$char, $end = '...');
	}

	/**
	 * [SELECT_BUSINESS_STORE_FIELD This function is used to select store field data]
	 */
	function SELECT_BUSINESS_STORE_FIELD() {

		$field = ['id','user_id','category_id','bs_name','slug','bs_website','bs_summary','bs_overview',
				'other_services','reference_url','bs_slogan','bs_notification_email_id','bs_logo','bs_logo_title','bs_latitude',
				'bs_longitude','bs_email','bs_email_token','bs_verified_email_id','bs_listing_approved',
				'is_limited','is_under_months','is_agree_terms','is_display_opening_hours','email_request_msg',
				'created_at','updated_at','created_by','last_updated_by'
	               ];
		return $field; 
	}
	/**
	 * [SELECT_BUSINESS_STORE_CUSTOME_FIELD This function is used to select store field data]
	*/
	function SELECT_BUSINESS_STORE_CUSTOME_FIELD() {

		$field = ['id','user_id','category_id','bs_name','slug','bs_email','bs_email_token'];
		return $field; 
	}

	/**
	 * [SELECT_BUSINESS_STORE_TELEPHONE This function is used to select phone data]
	 */
	function SELECT_BUSINESS_STORE_TELEPHONE() {

		$field = ['id','user_id','bs_id','phone_number','created_at','updated_at','created_by','last_updated_by'];
		return $field; 
	}

	/**
	 * Get footer quick links
	 * @author Bhargav Upadhyay
	 */
	function GETQUICKLINKS()
	{
	    $country_id = GET_COUNTRY_ID_BASE_ON_SEGMENT(GETSEGMENT(1));
		return \App\Models\Cms::select('id','title','url')->where(
			'status',\App\Models\Cms::STATUS_ACTIVE)->where('country_id',$country_id)->where('display_on_footer',1)->orderBy('display_order','ASC')->get();
	}

	/**
	 * [BUSINESS_STORE_JOB_DETAIL_URL Get Job Details Url]
	 * @param [type] $sortName [description]
	 * @param [type] $jobID    [description]
	 * @author Shekhar Shah
	 */
	function BUSINESS_STORE_JOB_DETAIL_URL($sortName,$jobID){

		return url('/').'/'.$sortName.'/business_account/my_job_details/'.Crypt::encrypt($jobID).'';
	}

	/**
     * Covert string to URL
     * @author Hirak
     */
    function stringToURL($string)
    {
        $string = trim($string);
        $string = str_replace(['/','-',' '], ['%2F','%2D','-'], $string);
        if(!is_arabic($string))
        {
            if(!ctype_upper($string))
            {
                $string = strtolower($string);
            }
        }
        $string = urlencode($string);
        return $string;
    }
    /**
     * Covert string to URL
     * @author Hirak
     */
    function URLToString($string)
    {
        $string = urldecode($string);
        $string = str_replace(['-','%2d','%2f'],[' ','-','/'],$string);
        if(!is_arabic($string))
        {
            if(!ctype_upper($string))
            {
                $string = ucwords($string);
            }
        }
        return $string;
    }
    /**
     * Get the details of country
     * @param  [type] $field [description]
     * @return [type]        [description]
     */
    function countryDetails($field = NULL)
    {
        $countryDetails = \Config::get("constantCountry");
        return (!empty($field)?($countryDetails->$field):$countryDetails);
    }

    /**
     * This function is used to redirect page using route name
     * @param  [type]     $redirectRoute [name of the route]
     */
    function REDIRECT_COMMON_FUNCTION($redirectRoute)
    {
    	return redirect()->route($redirectRoute);
    }

    /**
     * [SOCIAL_MEDIA_CALL_BACK_URL_FOR_GOOGLE This function is used to return Google call back url]
     * @param [type] $countryCode [description]
     * @author Chirag Ghevariya
     */
    function SOCIAL_MEDIA_CALL_BACK_URL_FOR_GOOGLE($countryCode)
    {
        return SITE_URL()."/".$countryCode."/google/login/callback";
    }

    /**
     * [SOCIAL_MEDIA_CALL_BACK_URL_FOR_GOOGLE This function is used to return facebook call back url]
     * @param [type] $countryCode [description]
     * @author Chirag Ghevariya
     */
    function SOCIAL_MEDIA_CALL_BACK_URL_FOR_FACEBOOK($countryCode)
    {
        return SITE_URL()."/".$countryCode."/facebook/login/callback";
    }

    /**
     * [SOCIAL_MEDIA_CALL_BACK_URL_FOR_LINKDIN This function is used to return linkedin call back url]
     * @param [type] $countryCode [description]
     * @author Chirag Ghevariya
     */
    function SOCIAL_MEDIA_CALL_BACK_URL_FOR_LINKDIN($countryCode)
    {
		return SITE_URL()."/".$countryCode."/linkedin/login/callback";
    }

    /**
     * Get the all activated country code array
     * @return [type]        [array]
     */
    function GET_ALL_ACTIVATED_COUNTRY_ID()
    {
    	return \App\Models\Country::pluck('id')->toArray();
    }
    /**
     * Get social media redirect URL
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    function getSocialMediaRedirectURL($type)
    {
        $arr = [
            'facebook'=>SOCIAL_MEDIA_CALL_BACK_URL_FOR_FACEBOOK(GETSEGMENT(1)),
            'google'=>SOCIAL_MEDIA_CALL_BACK_URL_FOR_GOOGLE(GETSEGMENT(1)),
            'linkedin'=>SOCIAL_MEDIA_CALL_BACK_URL_FOR_LINKDIN(GETSEGMENT(1)),
        ];
        return $arr[$type];
    }
    /**
     * Reasons for cancel the review
     * @author Hirak
     * @param  [type] $reason [description]
     * @return [type]         [description]
     */
    function reasonForCancelReview($reason=NULL)
    {
        $arr = [
            '1'=>'Reason 1',
            '2'=>'Reason 2',
            '3'=>'Reason 3',
            '4'=>trans('lang_data.form_other'),
        ];
        if(isset($reason))
        {
            return $arr[$reason];
        }
        else
        {
            return $arr;
        }
    }
    /**
     * [CONVER_HOURS_TO_AM_PM_FORMAT This function is used to convert hours to am,pm time]
     * @param [type] $type [description]
     * @author Chirag Ghevariya
     */
    function CONVER_HOURS_TO_AM_PM_FORMAT($time)
    {	
    	$data = date("g:i a", strtotime($time));
    	return $data;
    }

    /**
     * [Generate random string]
     * @param [type] $type [string]
     * @author Bhargav Upadhyay
     */
    function GENERATE_RANDOM_STRING($n)
    {
    	$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
	    $randomString = ''; 
	  
	    for ($i = 0; $i < $n; $i++) { 
	        $index = rand(0, strlen($characters) - 1); 
	        $randomString .= $characters[$index]; 
	    } 
	  
	    return $randomString;
    }

    /**
     * Get the lang array
     * @author Hirak
     * @param  [type] $lang [description]
     * @return [type]       [description]
     */
    function getLangArr($currentLang=NULL)
    {
        $returnArr = [
            'en'=>trans('lang_data.english'),
            'ar'=>trans('lang_data.arabic'),
        ];
        if(isset($currentLang))
        {
            return $returnArr[getDefaultLanguage()];
        }
        else
        {
            return $returnArr;    
        }
    }
    /**
     * Get the default language
     * @author Hirak
     * @return [type] [description]
     */
    function getDefaultLanguage()
    {
        if(session()->has('currentLang') && session('currentLang')!='')
        {
            $lang = session('currentLang');
        }
        else
        {
            $lang = env('DEFAULT_LANGUAGE');
        }
        return $lang;
    }

    /**
     * [sendToDashboard Common function for redirect to dashboard]
     * @author Shekhar Shah
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    function sendToDashboard($data)
    {
    	if($data == null){
            $msg = trans('lang_data.you_dont_have_access');
            flash($msg)->error()->important();
            return true;
        } else {
        	return false;
        }
    }
    /**
     * Covert the uniord for arabic
     * @author Hirak
     * @param  [type] $u [description]
     */
    function uniord($u) {
        // i just copied this function fron the php.net comments, but it should work fine!
        $k = mb_convert_encoding($u, 'UCS-2LE', 'UTF-8');
        $k1 = ord(substr($k, 0, 1));
        $k2 = ord(substr($k, 1, 1));
        return $k2 * 256 + $k1;
    }
    /**
     * Check if string is arabic
     * @author Hirak
     * @return boolean      [description]
     */
    function is_arabic($str) {
        if(mb_detect_encoding($str) !== 'UTF-8') {
            $str = mb_convert_encoding($str,mb_detect_encoding($str),'UTF-8');
        }

        preg_match_all('/.|\n/u', $str, $matches);
        $chars = $matches[0];
        $arabic_count = 0;
        $latin_count = 0;
        $total_count = 0;
        foreach($chars as $char) {
            //$pos = ord($char); we cant use that, its not binary safe 
            $pos = uniord($char);
            //echo $char ." --> ".$pos.PHP_EOL;

            if($pos >= 1536 && $pos <= 1791) {
                $arabic_count++;
            } else if($pos > 123 && $pos < 123) {
                $latin_count++;
            }
            $total_count++;
        }
        if(($arabic_count/$total_count) > 0.6) {
            // 60% arabic chars, its probably arabic
            return true;
        }
        return false;
    }
    /**
    	 * Common operation for images function
    	 */
	function commonOperationsForImage($imagePath,$info,$vImg,$params=array())
	{
		// create a new true color image
        $mW =  1480;
        if(isset($params['mW']))
        {
            $mW = $params['mW'];
        } 
        $mH = 1024;
        if(isset($params['mH']))
        {
            $mH = $params['mH'];
        } 
		$dataHW    = app('Modules\Admin\Http\Controllers\PluginController')->resizeTheImage($imagePath,$mW,$mH);
		$iWidth      = @$dataHW['width'];
        $iHeight     = @$dataHW['height'];
        $vDstImg = @imagecreatetruecolor($iWidth, $iHeight);
        imagealphablending($vDstImg, false);
        imagesavealpha($vDstImg, true);
        // copy and resize part of an image with resampling
        imagecopyresampled($vDstImg, $vImg, 0, 0, 0, 0, $iWidth, $iHeight, $info[0], $info[1]);
        return $vDstImg;
	}
    /**
     * Resize the image
     * @author Hirak
     * @return [type] [description]
     */
    function resizeTheImage($imagePath,$params=array())
    {
    	
        if(file_exists($imagePath) && !is_dir($imagePath))
        {
            try{
                $info = getimagesize($imagePath);
                if (isset($info['mime']) && $info['mime'] == 'image/jpeg') 
                {
                    $vImg = imagecreatefromjpeg($imagePath);
                    $vDstImg = commonOperationsForImage($imagePath,$info,$vImg,$params);
                    imagejpeg($vDstImg, $imagePath, 50);
                }
                else if (isset($info['mime']) && $info['mime'] == 'image/webp') 
                {
                    $vImg = imagecreatefromwebp($imagePath);
                    $vDstImg = commonOperationsForImage($imagePath,$info,$vImg,$params);
                    imagewebp($vDstImg, $imagePath, 50);
                }
                elseif (isset($info['mime']) && $info['mime'] == 'image/png')
                {
                    $vImg = imagecreatefrompng($imagePath);
                    $vDstImg = commonOperationsForImage($imagePath,$info,$vImg,$params);
                    imagepng($vDstImg, $imagePath, 9);
                }
            }
            catch(\Exception $e)
            {
                
            }
        	
        }
    }
    /**
     * Get lang arr for insert data
     * @author Hirak
     * @return [type] [description]
     */
    function getLangArrForInsertData()
    {
        $arr = array();
        if(env('MULTILINGUAL'))
        {
            $arr = getLangArr();
            unset($arr['en']);
        }
        return $arr;
    }
    /**
     * This function is used for get maximum char limit in accreditations
     * @author Bhargav Upadhyay
     * @reviewer
     */
	function MAX_ACCREDIATIONS_CHARACTER_LIMIT()
	{
		return '20';
	}
	/**
     * This function is used for get maximum char limit
     * @author Shekhar Shah
     * @reviewer
     */
	function MAX_POSTCODE_LIMIT()
	{
		return '25';
	}
	/**
     * Check user already logged in or not
     * @author Bhargav Upadhyay
     * @reviewer
     */
	function CHECKLOGGEDIN()
	{
		$Businessuser 	= \Auth::guard('business')->user();
		$Frontuser 		= \Auth::guard()->user();
        if($Businessuser != NULL || $Frontuser != NULL)
        {
            return true;
        }
        else
        {
        	return false;
        }
	}

	/**
	 * [CONVERT_STRING_TO_STR_TO_LOWER description]
	 */
	function CONVERT_STRING_TO_STR_TO_LOWER($string){

		return strtolower($string);
	}

	/**
	 * [ALLOWIPREGISTERCHECK If return false then condition will not be executed where this function is called or used]
	 * @author Shekhar Shah
	 */
	function ALLOWIPREGISTERCHECK()
	{
		return true;
	}

	/**
	 * [GIVE_IP_ACCESS If return false then condition will not be executed where this function is called or used]
	 * @author Shekhar Shah
	 */
	function GIVE_IP_ACCESS()
	{
		return true;
	}

	/**
	 * [CHECK_IP_ACCESS Function checks whether the IP has given access for login page or not]
	 * @author Shekhar Shah
	 */
	function CHECK_IP_ACCESS()
	{
        $ip_address_array = $ip_address_range_array = array();
        $allowed_ip_array = \App\Models\LoginAccess::getLoginAccess();
        $ip_range_array = explode(".",get_client_ip());

        if(env('LOCALORLIVE') == 'live'){
	        $ip_range = $ip_range_array[0].'.'.$ip_range_array[1].'.'.$ip_range_array[2];
	        $range    = $ip_range_array[3];
        } else {
	        $ip_range = $ip_range_array[0];
        }

    	$checkIpRange = \App\Models\LoginAccess::select('ip_range','from_range','to_range')->where('ip_range',$ip_range)->first();

        $validUser = 1;
        if(isset($allowed_ip_array) && !empty($allowed_ip_array)){
            foreach($allowed_ip_array as $ip)
            {
                $ip_address_array[] 	  = $ip['ip_address'];
                $ip_address_range_array[] = $ip['ip_range'];
            }
            
            if(in_array(get_client_ip(), array_filter($ip_address_array))) 
            {
                $validUser = 1;
            } 
            else if($checkIpRange != NULL) 
            {
            	if(isset($range) && $range >= $checkIpRange->from_range && $range <= $checkIpRange->to_range)
            	{
                	$validUser = 1;
            	} else {
                	$validUser = 0;
            	}
            }
            else 
            {
                $validUser = 0;
            }
        }
        
        return ($validUser == 1)? false : true;
	}

    /**
     * [GET_ALL_COUNTRY_NAME Get the all country name from segment]
     * @author Shekhar Shah
     */
    function GET_ALL_COUNTRY_NAME()
    {
    	return \App\Models\Country::select('name')->where('sortname',GETSEGMENT(1))->first()->name;
    }

    /**
     * [CHANGESCOUNTRYTEXT Replace text according to country wise]
     * @author Shekhar Shah
     */
	function CHANGESCOUNTRYTEXT($cms_title)
	{
		$url = GETSEGMENT(1);
		$text = \App\Models\Cms::where('title',$cms_title)->where('status',\App\Models\Cms::STATUS_ACTIVE)->where('country_id',GET_COUNTRY_ID_BASE_ON_SEGMENT($url))->first()->long_description;
		$string = str_replace(['African','Africa'], [GET_ALL_COUNTRY_NAME(),GET_ALL_COUNTRY_NAME()], $text);
		
		if(env('MULTILINGUAL'))
		{
			$string = str_replace('Lifrica', 'The Gulf Connect', $string);
		}
		return $string;
	}

	/**
	 * [CHANGESEARCHBARTEXT Text changes for search bar country wise]
	 * @author Shekhar Shah
	 */
	function CHANGESEARCHBARTEXT()
	{
		if(env('MULTILINGUAL'))
		{
			return str_replace('Africa', GET_ALL_COUNTRY_NAME(), trans('lang_data.search_location_text'));
		} else {
			return trans('lang_data.search_location_text');
		}
	}
?>
