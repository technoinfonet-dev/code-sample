<?php
namespace App\Validator;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Input;
use Hash;
class CustomValidator extends Validator
{
	/**
     * This function is used for validate image
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckValidImage($attribute, $value, $parameters)
    {
		if(Input::hasFile($attribute))
		{
			if(!is_object($value) &&  isset($value[0]) && !empty($value[0]))
			{
				foreach($value as $v)
				{
					$extension = $v->getClientOriginalExtension();
					$extension  = strtolower($extension);
					if($extension=="jpg" || $extension=="png" || $extension=="jpeg")
					{
						return true;
					}
					else
					{
						return false;
					}
				}
			}
			else
			{
				$extension = $value->getClientOriginalExtension();
				$extension  = strtolower($extension);
				if($extension=="jpg" || $extension=="png" || $extension=="jpeg")
				{
					return true;
				}
				else
				{
					return false;
				}			
			}
		}
		else
		{
			return true;
		}
    }
	/**
     * This function is used for validate import file
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckImportFile($attribute, $value, $parameters)
    {
		if(Input::hasFile($attribute))
		{
			$extension = $value->getClientOriginalExtension();
			$extension  = strtolower($extension);
			if($extension=="xls" || $extension=="xlsx")
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return true;
		}
    }
	/**
     * This function is used for validate import file
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckImportXlsxFile($attribute, $value, $parameters)
    {
		if(Input::hasFile($attribute))
		{
			$extension = $value->getClientOriginalExtension();
			$extension  = strtolower($extension);
			if($extension=="xls" || $extension=="xlsx")
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return true;
		}
    }
    /**
     * This function is used for validate import file csv
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckImportCsvFile($attribute, $value, $parameters)
    {
		if(Input::hasFile($attribute))
		{
			$extension = $value->getClientOriginalExtension();
			$extension  = strtolower($extension);
			if($extension=="csv")
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return true;
		}
    }
    /**
     * This function is used for validate import file vcf
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckImportVcfFile($attribute, $value, $parameters)
    {
		if(Input::hasFile($attribute))
		{
			$extension = $value->getClientOriginalExtension();
			$extension  = strtolower($extension);
			if($extension=="vcf")
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return true;
		}
    }
	/**
     * This function is used for validate document file
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckDocumentFile($attribute, $value, $parameters)
    {
		if(Input::hasFile($attribute))
		{
			$extension = $value->getClientOriginalExtension();
			$extension  = strtolower($extension);
			if($extension=="jpg" || $extension=="png" || $extension=="jpeg" || $extension=="pdf")
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return true;
		}
    }
	
	/**
     * This function is used for validate name
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckName($attribute, $value, $parameters)
	{
		if(!empty($value))
		{
			return preg_match("/^[a-zA-Z0-9\-\'\s".regexToAddArabicCharacters(true)."]+$/u",$value);
		}
		else
		{
			return true;
		}
	}
	/**
     * This function is used for validate person name
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckPersonName($attribute, $value, $parameters)
	{
		if(!empty($value))
		{
			return preg_match("/^[a-zA-Z\'\s".regexToAddArabicCharacters(true)."]+$/u",$value);
		}
		else
		{
			return true;
		}
	}
	/**
     * This function is used for validate country/state/city name
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckLocationName($attribute, $value, $parameters)
	{
		if(!empty($value))
		{
			return preg_match("/^[a-zA-Z\'\s\:\!\^\&\(\"\_\?\,\.\)\-\/\@\#\;".regexToAddArabicCharacters(true)."]+$/u",$value);
		}
		else
		{
			return true;
		}
	}
	/**
     * This function is used for validate title
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckTitle($attribute, $value, $parameters)
	{
		if(!empty($value))
		{
			return preg_match("/^[a-zA-Z0-9\'\s\:\!\&\(\"\_\?\,\.\)\-\/\@\#\;".regexToAddArabicCharacters(true)."]+$/u",$value);
		}
		else
		{
			return true;
		}
	}

	/**
     * This function is used for validate title
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckValidCatTitle($attribute, $value, $parameters)
	{
		if(!empty($value))
		{
			return preg_match("/^[a-zA-Z0-9\'\s\:\!\&\(\"\_\?\,\.\)\-\/\@\#\;\'".regexToAddArabicCharacters(true)."]+$/u",$value);
		}
		else
		{
			return true;
		}
	}

	/**
     * This function is used for validate cms title location wise
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckCmsTitle($attribute, $value, $parameters)
	{
		$url = GETSEGMENT(1);
        $country = \App\Models\Country::where('sortname',$url)->first();
		if (isset($parameters[0]) && !empty($parameters[0])) {
            $count = \App\Models\Cms::where("id", "!=", $parameters[0])
                ->where("title", $value)
                ->where("country_id", $country->id)
                ->count();
        } else {
            $count = \App\Models\Cms::where("title", $value)->where("country_id", $country->id)->count();
        }
        if ($count === 0) {
            return true;
        } else {
            return false;
        }
	}

	/**
     * This function is used for validate banner title location wise
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckBannerTitle($attribute, $value, $parameters)
	{
		$url = GETSEGMENT(1);
        $country = \App\Models\Country::where('sortname',$url)->first();
		if (isset($parameters[0]) && !empty($parameters[0])) {
            $count = \App\Models\Banner::where("id", "!=", $parameters[0])
                ->where("title", $value)
                ->where("country_id", $country->id)
                ->count();
        } else {
            $count = \App\Models\Banner::where("title", $value)->where("country_id", $country->id)->count();
        }
        if ($count === 0) {
            return true;
        } else {
            return false;
        }
	}

	/* This function is used for validate category title location wise
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckCategoryTitle($attribute, $value, $parameters)
	{
		$url = GETSEGMENT(1);
        $country = \App\Models\Country::where('sortname',$url)->first();
		if (isset($parameters[0]) && !empty($parameters[0])) {
            $count = \App\Models\Category::where("id", "!=", $parameters[0])
                ->where("title", $value)
                ->where("country_id", $country->id)
                ->count();
        } else {
            $count = \App\Models\Category::where("title", $value)->where("country_id", $country->id)->count();
        }
        if ($count === 0) {
            return true;
        } else {
            return false;
        }
	}

	/* This function is used for validate career roles title location wise
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckCareerRolesTitle($attribute, $value, $parameters)
	{
		$url = GETSEGMENT(1);
        $country = \App\Models\Country::where('sortname',$url)->first();
		if (isset($parameters[0]) && !empty($parameters[0])) {
            $count = \App\Models\CareersRoles::where("id", "!=", $parameters[0])
                ->where("role_name", $value)
                ->where("country_id", $country->id)
                ->count();
        } else {
            $count = \App\Models\CareersRoles::where("role_name", $value)->where("country_id", $country->id)->count();
        }
        if ($count === 0) {
            return true;
        } else {
            return false;
        }
	}

	/* This function is used for validate career title location wise
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckCareerTitle($attribute, $value, $parameters)
	{
		$url = GETSEGMENT(1);
        $country = \App\Models\Country::where('sortname',$url)->first();
		if (isset($parameters[0]) && !empty($parameters[0])) {
            $count = \App\Models\Careers::where("id", "!=", $parameters[0])
                ->where("title", $value)
                ->where("country_id", $country->id)
                ->count();
        } else {
            $count = \App\Models\Careers::where("title", $value)->where("country_id", $country->id)->count();
        }
        if ($count === 0) {
            return true;
        } else {
            return false;
        }
	}

	/* This function is used for validate social title location wise
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckSocialTitle($attribute, $value, $parameters)
	{
		$url = GETSEGMENT(1);
        $country = \App\Models\Country::where('sortname',$url)->first();
		if (isset($parameters[0]) && !empty($parameters[0])) {
            $count = \App\Models\Social::where("id", "!=", $parameters[0])
                ->where("title", $value)
                ->where("country_id", $country->id)
                ->count();
        } else {
            $count = \App\Models\Social::where("title", $value)->where("country_id", $country->id)->count();
        }
        if ($count === 0) {
            return true;
        } else {
            return false;
        }
	}

	/* This function is used for validate social title location wise
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckCityTitle($attribute, $value, $parameters)
	{
		$url = GETSEGMENT(1);
        $country = \App\Models\Country::where('sortname',$url)->first();
		if (isset($parameters[0]) && !empty($parameters[0])) {
            $count = \App\Models\City::where("id", "!=", $parameters[0])
                ->where("name", $value)
                ->where("country_id", $country->id)
                ->count();
        } else {
            $count = \App\Models\City::where("name", $value)->where("country_id", $country->id)->count();
        }
        if ($count === 0) {
            return true;
        } else {
            return false;
        }
	}

	/**
     * This function is used for validate title
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateUniqueTitle($attribute, $value, $parameters)
	{
		$url = GETSEGMENT(1);
        $country = \App\Models\Country::where('sortname',$url)->first();
		if (isset($parameters[0]) && !empty($parameters[0])) {
            $count = \App\Models\BusinessAccreditations::where("id", "!=", $parameters[0])
                ->where("accreditation_name", $value)
                ->where("country_id", $country->id)
                ->count();
        } else {
            $count = \App\Models\BusinessAccreditations::where("accreditation_name", $value)->where("country_id", $country->id)->count();
        }
        if ($count === 0) {
            return true;
        } else {
            return false;
        }
	}
	/**
     * This function is used for validate title
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateBusinessHighlightsUniqueTitle($attribute, $value, $parameters)
	{
		$url = GETSEGMENT(1);
        $country = \App\Models\Country::where('sortname',$url)->first();
		if (isset($parameters[0]) && !empty($parameters[0])) {
            $count = \App\Models\BusinessHighlights::where("id", "!=", $parameters[0])
                ->where("highlight_name", $value)
                ->where("country_id", $country->id)
                ->count();
        } else {
            $count = \App\Models\BusinessHighlights::where("highlight_name", $value)->where("country_id", $country->id)->count();
        }
        if ($count === 0) {
            return true;
        } else {
            return false;
        }
	}
	/**
     * This function is used for validate title
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateBusinessOnlineProfileUniqueTitle($attribute, $value, $parameters)
	{
		$url = GETSEGMENT(1);
        $country = \App\Models\Country::where('sortname',$url)->first();
		if (isset($parameters[0]) && !empty($parameters[0])) {
            $count = \App\Models\BusinessOnlineprofiles::where("id", "!=", $parameters[0])
                ->where("title", $value)
                ->where("country_id", $country->id)
                ->count();
        } else {
            $count = \App\Models\BusinessOnlineprofiles::where("title", $value)->where("country_id", $country->id)->count();
        }
        if ($count === 0) {
            return true;
        } else {
            return false;
        }
	}
	/**
     * This function is used for validate title
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateBusinessPaymentsUniqueTitle($attribute, $value, $parameters)
	{
		$url = GETSEGMENT(1);
        $country = \App\Models\Country::where('sortname',$url)->first();
		if (isset($parameters[0]) && !empty($parameters[0])) {
            $count = \App\Models\BusinessPayments::where("id", "!=", $parameters[0])
                ->where("title", $value)
                ->where("country_id", $country->id)
                ->count();
        } else {
            $count = \App\Models\BusinessPayments::where("title", $value)->where("country_id", $country->id)->count();
        }
        if ($count === 0) {
            return true;
        } else {
            return false;
        }
	}
	/**
     * This function is used for validate title
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckTitleState($attribute, $value, $parameters)
	{	
		if(!empty($value))
		{
			return preg_match("/^[a-zA-Z0-9\'\s\:\!\&\(\"\_\?\,\.\)\-\/\@\#\;".regexToAddArabicCharacters(true)."]+$/u",$value);
		}
		else
		{
			return true;
		}
	}
	/**
     * This function is used for validate telephone number
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckTelephone($attribute, $value, $parameters)
	{
		if(!empty($value))
		{
			return preg_match("/^\(?\(?(\+\d{0,2}\)?\s?)?\(?\d{0,10}\)?[\s-]?\d{0,10}[\s-]?\d{0,10}\)?$/",$value);
		}
		else
		{
			return true;
		}
	}
	/**
     * This function is used for validate phone number
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validatePhonevalidate($attribute, $value, $parameters)
	{
		if(!empty($value))
		{
			return preg_match("/^[0-9\(\)\s\+]{8,15}$/",$value);
		}
		else
		{
			return true;
		}
	}
	/**
     * This function is used for validate old password
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateOldPassword($attribute, $value, $parameters)
	{
		return Hash::check($value, current($parameters));
	}
	/**
     * This function is used for check price
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckPrice($attribute, $value, $parameters)
	{
		if(!empty($value))
		{
			return preg_match("/^[0-9]+(\.[0-9]{1,2})?$/",str_replace(",","",$value));
		}
		else
		{
			return true;
		}
	}
	public function validatePasswordCheck($attribute, $value, $parameters)
	{	
		if (!empty($value)) 
		{
			return  preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[!@#\$%\^&\*\[\]'\';:_\-<>\., =\+\/\\])(?=.*[A-Z]).{8,}?$/",str_replace(",","",$value));
		}
		else
		{
			return true;
		}
	}
	/**
     * This function is used for check decimal points in price
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckDecimal($attribute, $value, $parameters)
	{
		if(!empty($value))
		{
			return preg_match("/^\d{0,50}(\.\d{1,2})?$/",$value);
		}
		else
		{
			return true;
		}
	}

	/**
     * This function is used for validate greater price
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
	 * @param $validator
     * @reviewer
     */
	public function validateCheckGreaterPrice($attribute, $value, $parameters, $validator)
	{
		if($value>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
     * This function is used for validate password
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
	 * @param $validator
     * @reviewer
     */
	public function validateCheckPassword($attribute, $value, $parameters, $validator)
	{
		return true;
		//return preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z\'\s\:\!\&\(\"\_\?\,\.\)\-\/\@\#\;]{8,}$/i",$value);
	}
	/**
     * This function is used for validate latitude
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
	 * @param $validator
     * @reviewer
     */
	public function validateCheckLatitude($attribute, $value, $parameters, $validator)
	{
		if(!empty($value))
		{
			$latitude_field = $parameters[0];
			$data = $validator->getData();
			$latitude_value = $data[$latitude_field];
			if(empty($latitude_value))
			{
				return false;
			}
			else
			{
				return true;
			}
		}
		else
		{
			return true;
		}
	}
	/**
     * This function is used for validate date
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
	 * @param $validator
     * @reviewer
     */
	public function validateCheckDate($attribute, $value, $parameters, $validator)
	{
		$input = $value;
		if(isset($input) && !empty($input))
		{
			$date_month = explode("-",$input);
			$day = (int)trim($date_month[0],'_');
			$month = (int)trim($date_month[1],'_');
			$year = (int)trim($date_month[2],'_');
			if(checkdate($month,$day,$year))
			{
				if((strtotime($input)>strtotime(date('d-m-Y'))))
				{
					return false;
				}
				else
				{
					return true;
				}
			}
			else
			{
				return false;
			}
		}
	}
	/**
     * This function is used for validate last given discount
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
	 * @param $validator
     * @reviewer
     */
	public function validateLastGivenDiscount($attribute, $value, $parameters, $validator)
	{
		$min_field 		= $parameters[0];
		$data 			= $validator->getData();
		$min_value 		= $data[$min_field];
		$value 			= str_replace(",","",$value);
		$min_value 		= str_replace(",","",$min_value);
		$diference 		= $min_value - $value;
		$current_per 	= $diference/$min_value*100;
		
		$min_value1 = substr($parameters[1], 0, -5);
		$min_value2 = substr($parameters[2], 0, -5);
		$diference1 = $min_value1 - $min_value2;
		$old_per	= $diference1/$min_value1*100;
		if( $current_per < $old_per )
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	/**
     * This function returns always false value
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
	 * @param $validator
     * @reviewer
     */
	public function validateAlwaysFalse($attribute, $value, $parameters, $validator)
	{
		return false;
	}

	/**
	 * [validateApiValidateAlphanumeric description]
	 * @param $attribute 
	 * @param $value     
	 * @param $parameters
	 * @param $validator 
	 * @author Chirag           
	 */
	public function validateApiValidateAlphanumeric($attribute, $value, $parameters, $validator){

		return preg_match("/^[a-zA-Z0-9 ".regexToAddArabicCharacters(true)."]*$/u",$value);
	}	

	public function validateApiCheckFrontUserEmailExit($attribute, $value, $parameters)
	{
        $sql    = \App\User::select(SELECT_USER_FIELD())->where(\DB::raw("convert(AES_DECRYPT(`email`, '".env('APP_AESENCRYPT_KEY')."') using latin1)"), $value)->where('user_type','!=','2');
		$count = $sql->count();

		if($count === 0){
			return true;
        }else{
        	return false;
        } 
	}

	/**
	 * [validateApiValidateAlphanumeric This function is used for validate address]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @param  [type] $validator  [description]
	 * @return [type]             [description]
	 */
	public function validateApiValidateAddress($attribute, $value, $parameters, $validator){
		return preg_match("/^([a-zA-Z0-9,-.?()\/& ".regexToAddArabicCharacters(true)."]+)$/u",$value);
	}

	/**
     * This function is used for validate business name
     * @author Shekhar Shah
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validateCheckBusinessName($attribute, $value, $parameters)
	{
		$checkRequest = CHECK_API_REQUEST_OR_WEB();
        $url = ($checkRequest != false)? GETSEGMENT(2) : GETSEGMENT(1) ;

        $country = \App\Models\Country::where('sortname',$url)->first();
		$sql = \App\User::select(SELECT_USER_FIELD())
						->with(['business_store'=>function($query){
							$query->select(SELECT_BUSINESS_STORE_FIELD());
						}])
						->whereHas('business_store',function($query) use ($value){
							$query->select(SELECT_BUSINESS_STORE_FIELD())->where('bs_name', 'LIKE', '%' . $value . '%');
						})->where('user_type', '1')->where('country_id',$country->id);
			
		$count = $sql->count();
        return ($count === 0) ? true : false;
	}

	/**
     * Check Email exist or not for Business User
     * @author Shekhar Shah
     * @param  $attribute 
     * @param  $value     
     * @param  $parameters
     * @param  $validator 
     */
    public static function validateCheckBusinessUserEmail($attribute, $value, $parameters, $validator)
    {
        $checkRequest = CHECK_API_REQUEST_OR_WEB();
        $url = ($checkRequest != false)? GETSEGMENT(2) : GETSEGMENT(1) ;
        
        $country = \App\Models\Country::where('sortname',$url)->first();
        $sql = \App\User::select(SELECT_USER_FIELD())->where(\DB::raw("convert(AES_DECRYPT(`email`, '".env('APP_AESENCRYPT_KEY')."') using latin1)"), $value)->where('user_type', '!=', '2');
        $count = $sql->count();
        return ($count === 0) ? true : false;
    }

    /**
	 * [validateApiValidateAlphanumeric This function is used for validate address]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @param  [type] $validator  [description]
	 * @return [type]             [description]
	 */
	public function validateApiNoHtml($attribute, $value, $parameters, $validator){
		return preg_match("/^([a-zA-Z0-9,.'@!#$^*?()& ".regexToAddArabicCharacters(true)."]+)$/u",$value);
	}

	/**
	 * [validateApiNoHtmlDisplayName This function is used for validate display name]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @param  [type] $validator  [description]
	 * @return [type]             [description]
	 */
	public function validateApiNoHtmlDisplayName($attribute, $value, $parameters, $validator){
		return preg_match("/^([a-zA-Z0-9,.!?()& ".regexToAddArabicCharacters(true)."]+)$/u",$value);
	}

	/**
	 * [validateAplhanumeric This function is used for validate alpfanumeric]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @param  [type] $validator  [description]
	 * @return [type]             [description]
	 */
	public function validateAlphanumeric($attribute, $value, $parameters, $validator){
		return preg_match("/^([a-zA-Z".regexToAddArabicCharacters(true)."]+)$/u",$value);
	}

	/**
	 * [validateApiNoHtmlAllowed This function is used for validate no html tags and special characters are allowed]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @param  [type] $validator  [description]
	 * @return [type]             [description]
	 */
	public function validateApiNoHtmlAllowed($attribute, $value, $parameters, $validator){
		return preg_match("/^([a-zA-Z0-9,.\-@!#$^*?',(.)&\n* ".regexToAddArabicCharacters(true)."]+)$/u",$value);
	}	

	/**
	 * [validateApiNoHtmlAllowed This function is used for validate no html tags and special characters are allowed]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @param  [type] $validator  [description]
	 * @return [type]             [description]
	 */
	public function validateApiCheckBusinessSummary($attribute, $value, $parameters, $validator){
		return preg_match('/^([a-zA-Z0-9,_+."@!#$^*?():;& -\/\r\n*'.regexToAddArabicCharacters(true).']+)$/u',$value);

	}	

	/**
	 * [validateApiNoHtmlAllowed This function is used for validate no html tags and special characters are allowed]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @param  [type] $validator  [description]
	 * @return [type]             [description]
	 */
	public function validateApiCheckBusinessSlogan($attribute, $value, $parameters, $validator){
		return preg_match("/^([a-zA-Z0-9,_+.@!#$^*?():;& -\/\r\n*' ".regexToAddArabicCharacters(true)."]+)$/u",$value);
	}

	/**
	 * [validateCheckMobile This function is used for validate mobile number]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @param  [type] $validator  [description]
	 * @return [type]             [description]
	 */
	public function validateCheckMobile($attribute, $value, $parameters, $validator){
		return preg_match("/^\(?\(?(\(?[+]?\d{0,3}\)?[\s-]?)?\(?\d{0,10}\)?[\s-]?\d{0,10}[\s-]?\d{0,10}\)?$/",$value);
	}	

	/**
	 * [validateCheckFrontUserEmail Check Front user email exists or not Admin Side]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @param  [type] $validator  [description]
	 * @return [type]             [description]
	 */
	public function validateCheckBothUsersEmail($attribute, $value, $parameters, $validator)
    {
        $userId = !empty($parameters[0]) ? $parameters[0] : "";
        $url = GETSEGMENT(1);
        $sql = \App\Models\User::select(SELECT_USER_FIELD())->where(\DB::raw("convert(AES_DECRYPT(`email`, '".env('APP_AESENCRYPT_KEY')."') using latin1)"), $value)->whereHas('country', function($sql) use ($url){
                    $sql->where('sortname',$url);
                })->where('user_type', '!=', '2');
        if (!empty($userId)) {
            $sql->where("id", "!=", $userId);
        }
        $count = $sql->count();
        return ($count == 0) ? true : false;
    }

    /**
     * [validateCheckFrontUserEmailCountry  Check Front user email exists or not in same Country Admin Side]
     * @param  [type] $attribute  [description]
     * @param  [type] $value      [description]
     * @param  [type] $parameters [description]
     * @param  [type] $validator  [description]
     * @return [type]             [description]
     */
    public static function validateCheckBothUsersEmailCountry($attribute, $value, $parameters, $validator)
    {
        $userId = !empty($parameters[0]) ? $parameters[0] : "";
        $url = GETSEGMENT(1);
        $sql = \App\Models\User::select(SELECT_USER_FIELD())->where(\DB::raw("convert(AES_DECRYPT(`email`, '".env('APP_AESENCRYPT_KEY')."') using latin1)"), $value)->whereHas('country', function($sql) use ($url){
                    $sql->where('sortname','!=',$url);
                })->where('user_type', '!=','2');
        if (!empty($userId)) {
            $sql->where("id", "!=", $userId);
        }
        $count = $sql->count();
        return ($count == 0) ? true : false;
    }

    /**
     * This function is used for validate business name
     * @author Chirag Ghevariya
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
    */
	public function validateCheckBusinessNameForAdmin($attribute, $value, $parameters)
	{
		$url = GETSEGMENT(1);
        $country = \App\Models\Country::where('sortname',$url)->first();

        $sql = \App\User::select(SELECT_USER_FIELD())
				->with(['business_store'=>function($query){
					$query->select(SELECT_BUSINESS_STORE_FIELD());
				}])
				->whereHas('business_store',function($query) use ($value){
					$query->select(SELECT_BUSINESS_STORE_FIELD())->where('bs_name', 'LIKE', '%' . $value . '%');
				})
				->where('user_type', '1')
				->where('country_id',$country->id);

        if (isset($parameters[0]) && $parameters[0] !="") {
        	$id = $parameters[0];
			$sql = $sql->where('id','!=',$id);

        }else{

			$sql = $sql;
		}
		$count = $sql->count();
        return ($count === 0) ? true : false;
	}

	/**
     * Check Email exist or not for Business User in Post a Job
     * @author Shekhar Shah
     * @param  $attribute 
     * @param  $value     
     * @param  $parameters
     * @param  $validator 
     */
    public static function validateCheckBusinessUserEmailJob($attribute, $value, $parameters, $validator)
    {
        $checkRequest = CHECK_API_REQUEST_OR_WEB();
        $url = ($checkRequest != false)? GETSEGMENT(2) : GETSEGMENT(1) ;
        $country = GET_COUNTRY_ID_BASE_ON_SEGMENT($url);
        $user    = \Auth::guard('business')->user();
        $userId = $user->id;
        $sql = \App\User::select(SELECT_USER_FIELD())->where(\DB::raw("convert(AES_DECRYPT(`email`, '".env('APP_AESENCRYPT_KEY')."') using latin1)"), $value)->where('user_type', '!=', '2');
        if (!empty($userId)) {
            $sql->where("id", "!=", $userId);
        }
        $count = $sql->count();
        return ($count === 0) ? true : false;
    }

    /**
     * [validateCheckNoHtmlBusinessName This function is used to check special characters exists in business name or not]
     * @author Shekhar Shah
     * @param  [type] $attribute  [description]
     * @param  [type] $value      [description]
     * @param  [type] $parameters [description]
     * @param  [type] $validator  [description]
     * @return [type]             [description]
     */
    public function validateCheckNoHtmlBusinessName($attribute, $value, $parameters, $validator){
		return preg_match("/^([a-zA-Z0-9,.:'@!#$`©^*™?()&\/ -".regexToAddArabicCharacters(true)."]+)$/u",$value);
	}

	/**
     * [validateCheckNumeric This function is used to check numeric values exists or not]
     * @author Shekhar Shah
     * @param  [type] $attribute  [description]
     * @param  [type] $value      [description]
     * @param  [type] $parameters [description]
     * @param  [type] $validator  [description]
     * @return [type]             [description]
     */
	public function validateCheckNumeric($attribute, $value, $parameters, $validator){
		return preg_match("/^([0-9]+)$/",$value);
	}

	/**
	 * [validateCheckFrontUserEmailJob Check Front user email exists or not Admin Side]
	 * @author Shekhar Shah
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @param  [type] $validator  [description]
	 * @return [type]             [description]
	 */
	public function validateCheckFrontUserEmailJob($attribute, $value, $parameters, $validator)
    {
        $userId = !empty($parameters[0]) ? $parameters[0] : "";
        $sql = \App\Models\User::select(SELECT_USER_FIELD())->where(\DB::raw("convert(AES_DECRYPT(`email`, '".env('APP_AESENCRYPT_KEY')."') using latin1)"), $value)->where('user_type', '!=', '2');
        if (!empty($userId)) {
            $sql->where("id", "!=", $userId);
        }
        $count = $sql->count();
        return ($count == 0) ? true : false;
    }

	/**
	 * [validateCheckEmailExistsForBoth Check Email exists or not in both user]
	 * @author Shekhar Shah
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @param  [type] $validator  [description]
	 * @return [type]             [description]
	 */
	public function validateCheckEmailExistsForBoth($attribute, $value, $parameters, $validator)
    {
        $userId = !empty($parameters[0]) ? $parameters[0] : "";
        $url = GETSEGMENT(1);
        $sql = \App\Models\User::select(SELECT_USER_FIELD())->where(\DB::raw("convert(AES_DECRYPT(`email`, '".env('APP_AESENCRYPT_KEY')."') using latin1)"), $value)->where('user_type', '!=','2');
        if (!empty($userId)) {
            $sql->where("id", "!=", $userId);
        }
        $count = $sql->count();
        return ($count == 0) ? true : false;
    }

    /**
     * [validateNoHtmlMessage  This function is used to check no html tags or special character exists in message]
     * @author Shekhar Shah
     * @param  [type] $attribute  [description]
     * @param  [type] $value      [description]
     * @param  [type] $parameters [description]
     * @param  [type] $validator  [description]
     * @return [type]             [description]
     */
    public function validateNoHtmlMessage($attribute, $value, $parameters, $validator){
    	return preg_match("/^([a-zA-Z0-9 ,.':;@!#$^*?()&\/\r\n* \" -".regexToAddArabicCharacters(true)."]+)$/u",$value);
	}

	/**
     * [validateNoHtmlMessage  This function is used to check no html tags or special character exists in message]
     * @author Shekhar Shah
     * @param  [type] $attribute  [description]
     * @param  [type] $value      [description]
     * @param  [type] $parameters [description]
     * @param  [type] $validator  [description]
     * @return [type]             [description]
     */
    public function validateDealsAllowedChar($attribute, $value, $parameters, $validator){
    	return preg_match("/^([a-zA-Z0-9%&-\/_ ".regexToAddArabicCharacters(true)."]+)$/u",$value);
	}

	/**
     * [validateNoHtmlMessage  This function is used to check valid postcode]
     * @author Shekhar Shah
     * @param  [type] $attribute  [description]
     * @param  [type] $value      [description]
     * @param  [type] $parameters [description]
     * @param  [type] $validator  [description]
     * @return [type]             [description]
     */
    public function validateCheckPostCode($attribute, $value, $parameters, $validator){
    	return preg_match("/^([a-zA-Z0-9-.: ".regexToAddArabicCharacters(true)."]+)$/u",$value);
	}


    public static function validateCheckCoupanCodeExit($attribute, $value, $parameters, $validator)
    {	

		$url =GETSEGMENT(1);
        $country = \App\Models\Country::where('sortname',$url)->first();

        if (isset($parameters[0]) && $parameters[0] !="") {
        	$id = $parameters[0];
	        $sql = \App\Models\CoupanCode::where('id','!=',$id)
	        							->where("coupan_code", $value)
	        							->where('country_id',$country->id);

        }else{

	        $sql = \App\Models\CoupanCode::where("coupan_code", $value)
	        							->where('country_id',$country->id);
		}
	    $count = $sql->count();
    	return ($count === 0) ? true : false;
    }

    /**
     * This function is used for validate cms title location wise
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validatecheckCouponCodeExit($attribute, $value, $parameters)
	{
		$url = GETSEGMENT(1);
        $country = \App\Models\Country::where('sortname',$url)->first();
        $checkCouponCodeExit = \App\Models\CoupanCode::where('country_id',$country->id)->where('status',\App\Models\CoupanCode::STATUS_ACTIVE)->where('paid_or_free','0')->where('coupan_code',$value)->first();
        	
        if ($checkCouponCodeExit == null) {
        	return false;
        } else {
            return true;
        }
	}
	/**
     * This function is used for validate cms title location wise
     * @author Hirak
	 * @param $attribute
	 * @param $value
	 * @param $parameters
     * @reviewer
     */
	public function validatecheckCouponCodeAlreadyUsed($attribute, $value, $parameters)
	{
		$url = GETSEGMENT(1);
        $country = \App\Models\Country::where('sortname',$url)->first();
        $checkCouponAlreayUsed = \App\Models\UsedCouponCode::where('country_id',$country->id)->where('coupan_code',$value)->first();
        	
        if ($checkCouponAlreayUsed == null) {
        	return true;
        } else {
            return false;
        }
	}

	/**
	 * [validatecheckSocialAccountExit This function is used to check social accont already exists or not]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @return [type]             [description]
	 * @author Chirag Ghevariya
	 */
	public function validatecheckSocialAccountExit($attribute, $value, $parameters)
	{
		$url = GETSEGMENT(1);
        $country = \App\Models\Country::where('sortname',$url)->first();
        $checkCouponAlreayUsed = \App\Models\User::select(SELECT_USER_FIELD())->where(\DB::raw("convert(AES_DECRYPT(`email`, '".env('APP_AESENCRYPT_KEY')."') using latin1)"),$value)->first();
        	
        if ($checkCouponAlreayUsed !=null && $checkCouponAlreayUsed->is_social_login == 1) {

        	return false;

        } else {

            return true;
        }
	}

	/**
	 * [validateCheckArea  This function is used to check area characters are valid or not]
	 * @param $attribute 
	 * @param $value     
	 * @param $parameters
	 * @param $validator 
	 * @author Shekhar Shah
	 */
	public function validateCheckArea($attribute, $value, $parameters, $validator)
	{
		return preg_match("/^[a-zA-Z0-9,-.()& ".regexToAddArabicCharacters(true)."]*$/u",$value);
	}

	/**
	 * [validateCheckJobTitle This function is used to check job title valid or not]
	 * @param $attribute 
	 * @param $value     
	 * @param $parameters
	 * @param $validator 
	 * @author Shekhar Shah
	 */
	public function validateCheckJobTitle($attribute, $value, $parameters, $validator){

		return preg_match("/^[a-zA-Z0-9:. -".regexToAddArabicCharacters(true)."]*$/u",$value);
	}

	/**
	 * [validateFirstName This function is used for validate alpfanumeric]
	 * [validateCheckAdminUserEmail Check Front admin user email exists or not]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @param  [type] $validator  [description]
	 * @return [type]             [description]
	 */
	public function validateCheckFirstName($attribute, $value, $parameters, $validator){
		return preg_match("/^([a-zA-Z0-9 ".regexToAddArabicCharacters(true)."]+)$/u",$value);
	}	
	/**
	 * [validateLastName This function is used for validate alpfanumeric]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @param  [type] $validator  [description]
	 * @return [type]             [description]
	 */
	public function validateCheckLastName($attribute, $value, $parameters, $validator){
		return preg_match("/^([a-zA-Z0-9 ".regexToAddArabicCharacters(true)."]+)$/u",$value);
	}
	
	public function validateCheckAdminUserEmail($attribute, $value, $parameters, $validator)
    {
        $userId = !empty($parameters[0]) ? $parameters[0] : "";
        $url = GETSEGMENT(1);
        $sql = \App\Models\User::select(SELECT_USER_FIELD())->where(\DB::raw("convert(AES_DECRYPT(`email`, '".env('APP_AESENCRYPT_KEY')."') using latin1)"), $value)->whereHas('country', function($sql) use ($url){
                    $sql->where('sortname',$url);
                })->where('user_type', '2');
        
        if (!empty($userId)) {
            $sql->where("id", "!=", $userId);
        }
        $count = $sql->count();
        return ($count == 0) ? true : false;
    }	

    public function validateCheckvalidCouponCodeForRegisterTime($attribute, $value, $parameters, $validator)
    {
    	$url = GETSEGMENT(1);
        $country = \App\Models\Country::where('sortname',$url)->first();
        if (isset($value) && !empty($value)) {

	        $checkCouponCodeExit = \App\Models\CoupanCode::where('country_id',$country->id)->where('status',\App\Models\CoupanCode::STATUS_ACTIVE)->where('paid_or_free','0')->where('coupan_code',$value)->first();
	            
	        if($checkCouponCodeExit == null) {

	            return false;

	        }else{

	            return true;
	        }
        	
        }else{
        	
        	return true;
        }
    }

    /**
     * [CheckIpAddress  This function is used to ip address exists or not]
	 * @author Shekhar Shah
     * @param  [type] $attribute  [description]
     * @param  [type] $value      [description]
     * @param  [type] $parameters [description]
     * @param  [type] $validator  [description]
     * @return [type]             [description]
     */
    public function validateCheckIpAddress($attribute, $value, $parameters, $validator)
    {
        $recordId = !empty($parameters[0]) ? $parameters[0] : "";
        $sql = \App\Models\LoginAccess::where("ip_address", $value);

        if (!empty($recordId)) {
            $sql->where("id", "!=", $recordId);
        }
        $count = $sql->count();
        return ($count == 0) ? true : false;
    }

    /**
     * [CheckIpRange  This function is used to ip address exists or not]
	 * @author Shekhar Shah
     * @param  [type] $attribute  [description]
     * @param  [type] $value      [description]
     * @param  [type] $parameters [description]
     * @param  [type] $validator  [description]
     * @return [type]             [description]
     */
    public function validateCheckIpRange($attribute, $value, $parameters, $validator)
    {
        $recordId = !empty($parameters[0]) ? $parameters[0] : "";
        $sql = \App\Models\LoginAccess::where("ip_range", $value);

        if (!empty($recordId)) {
            $sql->where("id", "!=", $recordId);
        }
        $count = $sql->count();
        return ($count == 0) ? true : false;
    }
}
?>