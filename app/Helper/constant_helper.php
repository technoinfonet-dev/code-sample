<?php
	/**
     * This function is used for get static site url
     * @author Hirak
     * @reviewer
     */
	function STATIC_SITE_URL()
	{
        return \URL::to('/').'/';
	}
	/**
     * This function is used for get static site path
     * @author Hirak
     * @reviewer
     */
	function STATIC_SITE_PATH()
	{
		return public_path().'/';
	}
	/**
     * This function is used for get admin panel path
     * @author Hirak
     * @reviewer
     */
	function ADMIN_KEYWORD()
	{
		if(env('MULTILINGUAL')) {
			return "gulf-admin";
		} else {
			return "lifrica-admin";
		}
	}
	/**
     * This function is used for get site url
     * @author Hirak
     * @reviewer
     */
	function SITE_URL()
	{
		return url('/');
	}
	/**
     * This function is used for get front url
     * @author Hirak
     * @reviewer
     */
	function FRONT_URL()
	{
		return url("/")."/";
	}
	/**
     * This function is used for get front image url
     * @author Hirak
     * @reviewer
     */
	function FRONT_IMAGE_URL()
	{
		return STATIC_SITE_URL().'front/images'."/";
	}
	/**
     * This function is used for get front css url
     * @author Hirak
     * @reviewer
     */
	function FRONT_CSS_URL()
	{
		return STATIC_SITE_URL().'front/css'."/";
	}
	/**
     * This function is used for storing store hits pdf to specified directory
     * @author Shekhar
     * @reviewer
     */
	function STORE_HITS_REPORT_UPLOAD_PATH()
	{
		return STATIC_SITE_PATH().'admin/uploads/store_hits_report/';
	}

	/**
     * This function is used to upload job report pdf to the specified directory
     * @author Shekhar
     * @reviewer
     */
	function JOB_REPORT_UPLOAD_PATH()
	{
		return STATIC_SITE_PATH().'admin/uploads/job_report/';
	}
	/**
     * This function is used for get admin url
     * @author Hirak
     * @reviewer
     */
	function ADMIN_URL()
	{
		return url(GETSEGMENT(1).'/'.ADMIN_KEYWORD().'/')."/";
	}
	/**
     * This function is used for get admin image url
     * @author Hirak
     * @reviewer
     */
	function ADMIN_IMAGE_URL()
	{
		return url('admin/images')."/";
	}
	/**
     * This function is used for get admin image url
     * @author Hirak
     * @reviewer
     */
	function ADMIN_IMG_URL()
	{
		return url('admin/img')."/";
	}
	/**
     * This function is used for get admin css url
     * @author Hirak
     * @reviewer
     */
	function ADMIN_CSS_URL()
	{
		return url('admin/css')."/";
	}
	/**
     * This function is used for get admin js url
     * @author Hirak
     * @reviewer
     */
	function ADMIN_JS_URL()
	{
		return url('admin/js')."/";
	}
	/**
     * This function is used for get admin lib url
     * @author Hirak
     * @reviewer
     */
	function ADMIN_LIB_URL()
	{
		return url('admin/lib')."/";
	}
	/**
     * This function is used for get admin file manager url
     * @author Hirak
     * @reviewer
     */
	function ADMIN_FILE_MANAGER_URL()
	{
		return url('admin/file-manager')."/";
	}
	/**
     * This function is used for get user upload url
     * @author Hirak
     * @reviewer
     */
	function USER_UPLOAD_URL()
	{
		return STATIC_SITE_URL().'admin/uploads/user/profile_image'."/";
	}

	/**
     * This function is used for get cms upload url
     * @author Hirak
     * @reviewer
     */
	function CMS_UPLOAD_URL()
	{
		return asset('admin/uploads/cms')."/";
		
	}
	/**
     * This function is used for get cms content upload url
     * @author Hirak
     * @reviewer
     */
	function CMS_CONTENT_UPLOAD_URL()
	{
		return asset('admin/uploads/cms_content')."/";
	}
	/**
     * This function is used for get banner upload url
     * @author Hirak
     * @reviewer
     */
	function BANNER_UPLOAD_URL()
	{
		return STATIC_SITE_URL().'admin/uploads/banner'."/";
	}
	/**
	 * This function is used to get category upload URL
	 */
	function CATEGORY_UPLOAD_URL()
	{
		return asset('admin/uploads/category')."/";
	}
	/**
	 * This function is used to get setting home page banner upload URL
	 */
	function SETTING_HOME_PAGE_BANNER_UPLOAD_URL()
	{
		return STATIC_SITE_URL().'admin/uploads/setting/home_page_banner'."/";
	}
	/**
	 * This function is used to get setting user cover upload URL
	 */
	function SETTING_USER_COVER_UPLOAD_URL()
	{
		return STATIC_SITE_URL().'admin/uploads/setting/user_cover'."/";
	}
	/**
     * This function is used for get setting favicon upload url
     * @author Hirak
     * @reviewer
     */
	function SETTING_FAVICON_UPLOAD_URL()
	{
		return STATIC_SITE_URL().'admin/uploads/setting/favicon'."/";
	}
	/**
     * This function is used for get setting logo upload url
     * @author Hirak
     * @reviewer
     */
	function SETTING_LOGO_UPLOAD_URL()
	{
		return STATIC_SITE_URL().'admin/uploads/setting/logo'."/";
	}

	/**
     * This function is used for get setting admin logo upload url
     * @author Bhargav Upadhyay
     * @reviewer
     */
	function SETTING_ADMIN_LOGO_UPLOAD_URL()
	{
		return STATIC_SITE_URL().'admin/uploads/setting/admin_logo'."/";
	}

	/**
     * This function is used to get business payments media upload url
     * @author Hirak
     * @reviewer
     */
	function BUSINESS_PAYMENTS_MEDIA_UPLOAD_URL()
	{
		return asset('admin/uploads/business_payments')."/";
	}

	/**
     * This function is used to get no image found url
     * @author Hirak
     * @reviewer
     */
	function NO_IMAGE_FOUND_URL()
	{
		return asset('images')."/";
	}

	/**
     * This function is used to get no image name
     * @author Hirak
     * @reviewer
     */
	function NO_IMAGE_NAME()
	{
		return "no-image.png";
	}

	/**
     * This function is used to get social media upload url
     * @author Hirak
     * @reviewer
     */
	function SOCIAL_MEDIA_UPLOAD_URL()
	{
		return asset('admin/uploads/social')."/";
	}
	/**
	 * This function is used to get awards image upload url
	 */
	function AWARDS_IMAGE_UPLOAD_URL()
	{
		return asset('admin/uploads/awards/image')."/";
	}
	/**
     * This function is used for get sample upload url
     * @author Hirak
     * @reviewer
     */
	function SAMPLES_UPLOAD_URL()
	{
		return STATIC_SITE_URL().'admin/samples'."/";
	}
	
	/**
     * This function is used to get the user's business photos upload path
     * @author Hirak
     * @reviewer
     */
	function USER_UPLOAD_BUSINESS_PHOTO()
	{
		return STATIC_SITE_PATH().'admin/uploads/user/business_photos/';
	}

	/**
     * This function is used to get the user's business photos upload url
     * @author Hirak
     * @reviewer
     */
	function USER_UPLOAD_BUSINESS_PHOTO_URL()
	{	
		return STATIC_SITE_URL().'admin/uploads/user/business_photos'."/";
	}

	/**
     * This function is used to get the user's business logo upload path
     * @author Hirak
     * @reviewer
     */
	function USER_UPLOAD_BUSINESS_LOGO()
	{
		return STATIC_SITE_PATH().'admin/uploads/user/business_logo/';
	}

	/**
     * This function is used to get the user's business logo upload url
     * @author Hirak
     * @reviewer
     */
	function USER_UPLOAD_BUSINESS_URL()
	{	
		return STATIC_SITE_URL().'admin/uploads/user/business_logo'."/";		
	}


	/**
     * This function is used to get the user's profile image upload path
     * @author Hirak
     * @reviewer
     */
	function USER_UPLOAD_PATH()
	{
		return STATIC_SITE_PATH().'admin/uploads/user/profile_image/';
	}

	/**
     * This function is used to get the user's cover image upload path
     * @author Hirak
     * @reviewer
     */
	function USER_UPLOAD_OWN_COVER_IMAGE_PATH()
	{
		return STATIC_SITE_PATH().'admin/uploads/user/user_cover/';
	}

	/**
     * This function is used to get the user's cover image upload url
     * @author Hirak
     * @reviewer
     */
	function USER_UPLOAD_OWN_COVER_IMAGE_URL()
	{
		return STATIC_SITE_URL().'admin/uploads/user/user_cover'."/";
	}

	/**
     * This function is used for get cms upload path
     * @author Hirak
     * @reviewer
     */
	function CMS_UPLOAD_PATH()
	{
		return public_path('admin/uploads/cms/');
	}
	/**
     * This function is used for get cms content upload path
     * @author Hirak
     * @reviewer
     */
	function CMS_CONTENT_UPLOAD_PATH()
	{
		return public_path('admin/uploads/cms_content')."/";
	}
	/**
     * This function is used for get banner upload path
     * @author Hirak
     * @reviewer
     */
	function BANNER_UPLOAD_PATH()
	{
		return public_path('admin/uploads/banner')."/";
	}
	
	/**
     * This function is used for get category upload path
     * @author Hirak
     * @reviewer
     */
	function CATEGORY_UPLOAD_PATH()
	{
		return public_path('admin/uploads/category')."/";
	}
	/**
	 * This function is used to get setting home page banner upload path
	 */
	function SETTING_HOME_PAGE_BANNER_UPLOAD_PATH()
	{
		return STATIC_SITE_PATH().'admin/uploads/setting/home_page_banner/';

	}
	/**
	 * This function is used to get the setting user cover upload path
	 */
	function SETTING_USER_COVER_UPLOAD_PATH()
	{
		return STATIC_SITE_PATH().'admin/uploads/setting/user_cover/';
	}
	/**
     * This function is used for get setting favicon upload path
     * @author Hirak
     * @reviewer
     */
	function SETTING_FAVICON_UPLOAD_PATH()
	{
		return STATIC_SITE_PATH().'admin/uploads/setting/favicon/';
	}
	/**
     * This function is used for get setting logo upload path
     * @author Hirak
     * @reviewer
     */
	function SETTING_LOGO_UPLOAD_PATH()
	{
		return STATIC_SITE_PATH().'admin/uploads/setting/logo/';
	}

	/**
     * This function is used for get setting admin logo upload path
     * @author Bhargav Upadhyay
     * @reviewer
     */
	function SETTING_ADMIN_LOGO_UPLOAD_PATH()
	{
		return STATIC_SITE_PATH().'admin/uploads/setting/admin_logo/';
	}

	/**
     * This function is used to get business payments media upload path
     * @author Hirak
     * @reviewer
     */
	function BUSINESS_PAYMENTS_MEDIA_UPLOAD_PATH()
	{
		return public_path('admin/uploads/business_payments')."/";
	}


	/**
     * This function is used for get social media path
     * @author Hirak
     * @reviewer
     */
	function SOCIAL_MEDIA_UPLOAD_PATH()
	{
		return public_path('admin/uploads/social')."/";
	}
	/**
	 * This function is used to get awards image upload path
	 */
	function AWARDS_IMAGE_UPLOAD_PATH()
	{
		return public_path('admin/uploads/awards/image')."/";
	}
	/**
     * This function is used for get samples upload path
     * @author Hirak
     * @reviewer
     */
	function SAMPLES_UPLOAD_PATH()
	{
		return STATIC_SITE_PATH().'admin/samples/';
	}
	/**
	 * This function is used to get tinymce image upload url
	 */
	function TINYMCE_IMAGE_UPLOAD_URL()
	{
	    return STATIC_SITE_URL() . 'admin/uploads/tinymce' . "/";
	}
	/**
	 * This function is used to get tinymce image upload path
	 */
	function TINYMCE_IMAGE_UPLOAD_PATH()
	{
	    return public_path('admin/uploads/tinymce') . "/";
	}
	/**
     * This function is used for get admin area keyword
     * @author PARTH
     * @reviewer
     */
	function ADMIN_AREA_KEYWORD()
	{
		return "area";
	}
	/**
     * This function is used for get property image upload path
     * @author Hirak
     * @reviewer
     */
	function PROPERTY_IMAGE_UPLOAD_PATH()
	{
		return public_path('admin/uploads/property/image')."/";
	}
	/**
	 * This function is used to get admin category keyword
	 */
	function ADMIN_CATEGORY_KEYWORD()
	{
		return "categories";
	}
	/**
	 * This function is used to get admin business keyword
	 */
	function ADMIN_BUSINESS_KEYWORD()
	{
		return "business_store";
	}
	/**
	 * This function is used to get business store filename
	 */
	function BUSINESS_STORE_FILENAME()
	{
		if(env('MULTILINGUAL') == TRUE)
		{
			return "business_stores_uae";
		}
		else
		{
			return ADMIN_BUSINESS_KEYWORD();
		}
	}
	/**
	 * This function is used to get business user csv keyword
	 */
	function BUSIENSS_USER_CSV_KEYWORD()
	{
		return "sample_csv";
	}
	/**
     * This function is used for get admin seo feature keyword
     * @author Bhargav Upadhyay
     * @reviewer
     */
	function ADMIN_SEO_FEATURES_KEYWORD()
	{
		return "SEOFEATURES";
	}
	/**
     * This function is used for get front keyword contact us
     * @author Hirak
     * @reviewer
     */
	function FRONT_CONTACT_US_KEYWORD()
	{
		return 'contact-us';
	}
	/**
     * This function is used for get country code
     * @author Hirak
     * @reviewer
     */
	function COUNTRY_CODE()
	{
		return GETSEGMENT(1);
	}
	/**
     * This function is used for auto complete off
     * @author Hirak
     * @reviewer
     */
	function AUTO_COMPLATE_ON_OF(){
		return "off"; 
		// return "new-password"; 
	}

	/**
     * This function is used for get segment
     * @author Bhargav Upadhyay
     * @reviewer
     */
	function GETSEGMENT($segment){
		return \Request::segment($segment);
	}

	/**
     * This function is used for get current url
     * @author Shekhar Shah
     * @reviewer
     */
	function GETCURRENTURL(){
		return url()->current();
	}

	/**
	 * This function is used to verify user url
	 */
	function VERIFY_FRONT_USER_URL(){

		return "account/verifyfrontuser/";
	}	
	/**
	 * This function is used to verify business user url
	 */
	function VERIFY_BUSINESS_USER_URL(){

		return "business_account/verifyfrontBusinessuser/";
	}	
	/**
	 * This function is used to get api home page url
	 */
	function API_GET_HOME_PAGE_URL(){

		if (\Request::segment(1) == API_NAME_KEYWORD()) {
			
			return url('/').'/'.\Request::segment(2);
			
		}else{

			return url('/').'/'.\Request::segment(1);
		}
	}

	/**
	 * This function is used to verify forgot password link for front user
	 */
	function VERIFY_FRONT_USER_FORGOT_PASS_URL(){

		return "account/reset_pass/";
	}

	/**
	 * This function is used to verify forgot password link for business user
	 */
	function VERIFY_BUSINESS_USER_FORGOT_PASS_URL(){

		return "account/business_reset_pass/";
	}
	/**
	 * This function is used to get public directory path
	 */
	function SITE_PATH()
	{
		return public_path('/');
	}

	/**
	 * This function is used to get api keyword
	 */
	function API_NAME_KEYWORD()
	{
		return 'api';
	}

	/**
	 * [LATITUDE_CONSTANT This function is used to get latitude default value]
	 * @author Chirag Ghevariya
	 */
	function LATITUDE_CONSTANT(){

		return '13.2543';
	}	

	/**
	 * [LONGITUDE_CONSTANT This function is used to get longitude default value]
	 * @author Chirag Ghevariya
	 */
	function LONGITUDE_CONSTANT(){

		return '34.3015';
	}

	/**
	 * [OPENING_START_TIME_CONSTANT This function is used to get default opening time]
	 * @author Chirag Ghevariya
	 */
	function OPENING_START_TIME_CONSTANT(){

		return '10:00';
	}

	/**
	 * [OPENING_END_TIME_CONSTANT This function is used to get default closing time]
	 * @author Chriag Ghevariya
	 */
	function OPENING_END_TIME_CONSTANT(){

		return '19:00';
	}

	/**
     * This function is used for get blog upload path
     * @author Bhargav Upadhyay
     * @reviewer
     */
	function BLOG_UPLOAD_PATH()
	{
		return public_path('admin/uploads/blog')."/";
	}

	/**
     * This function is used for get blog upload url
     * @author Bhargav Upadhyay
     * @reviewer
     */
	function BLOG_UPLOAD_URL()
	{
		return asset('admin/uploads/blog')."/";
	}

	/**
     * This function is used for return 404 view page
     * @author Bhargav Upadhyay
     * @reviewer
     */
	function GET404VIEW()
	{
		$tabTitle = trans('lang_data.page_not_found');
        return view('errors.404', compact('tabTitle'));
	}

    /**
     * This function is used to get coupon code file name keyword
     * @author Hirak
     */
	function COUPON_CODE_FILE_NAME_KEYWORD()
	{
		return "coupon_code.xls";
	}
    /**
     * Append regex to add arabic characters
     * @author Hirak
     */
    function regexToAddArabicCharacters($serverSide=false)
    {
        if($serverSide)
        {
        	return "\x{0621}-\x{064A9}";
        }
        else
        {
        	return "\u0621-\u064A0-9";
        }
        
    }

    /**
     * This function is used for get database backup upload path
     * @author Shekhar Shah
     */
    function DATABASE_BACKUP_UPLOAD_PATH()
	{
		return public_path('admin/uploads/database_backup')."/";
	}

	/**
     * This function is used for get database backup upload url
     * @author Shekhar Shah
     */
	function DATABASE_BACKUP_UPLOAD_URL()
	{
		return url('admin/uploads/database_backup')."/";
	}

	/**
	 * Get database_backup.php file from directory
	 */
	function GET_DATABASE_FILE_PATH()
	{
		return SITE_URL()."database_backup.php";
	}
	
?>
