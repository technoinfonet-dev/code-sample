<?php

namespace App\Http\Controllers;

use App\Models\Careers;
use App\Models\City;
use App\Models\Cms;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->careerObj    = new Careers;
        $this->cityObj      = new City;
        $this->cmsObj       = new Cms;
    }

    /**
     * Display a listing of the career.
     * @param $request
     * @return data
     */
    public function index(Request $request)
    {
        $input          = $request->all();
        $search_array   = array();
        $career_role_id = $city_id = $keywords = "";
        $url            = GETSEGMENT(1);
        
        if (!empty($input['role_name'])) {
            $career_role_id = \Crypt::decrypt($input['role_name']);
        }
        if (!empty($input['location'])) {
            $city_id = \Crypt::decrypt($input['location']);
        }
        if (!empty($input['keywords'])) {
            $keywords = $input['keywords'];
        }

        $Career = $this->careerObj->getCareers($input);
       
        $country = GET_COUNTRY_ID_BASE_ON_SEGMENT(GETSEGMENT(1));

        $City = $this->cityObj->getCityData();

        $getPage  = $this->cmsObj->getCMSCms($country);

        if ($getPage != null) {
            $tabTitle = $meta_description = $meta_keyword = "";
            if($getPage->seo != null)
            {
                $tabTitle           = isset($getPage->seo->seo_title) && !empty($getPage->seo->seo_title) ? $getPage->seo->seo_title : STR_TO_WORD_FOR_URL($getPage->url);
                
                $meta_description   = isset($getPage->seo->seo_description) && !empty($getPage->seo->seo_description) ? $getPage->seo->seo_description : "";
                
                $meta_keyword       = isset($getPage->seo->seo_keyword) && !empty($getPage->seo->seo_keyword) ? $getPage->seo->seo_keyword : "";
            }
            else
            {
                $tabTitle = STR_TO_WORD_FOR_URL($getPage->url);
            }
            
            $get_keywords = $get_role_name = $get_location = "";

            if (!empty($input['keywords'])) {
                $get_keywords = $input['keywords'];
            }

            if (!empty($input['role_name'])) {
                $get_role_name = \Crypt::decrypt($input['role_name']);
            }

            if (!empty($input['location'])) {
                $get_location = \Crypt::decrypt($input['location']);
            }
            
            return view('front.modules.careers.career', compact('getPage', 'tabTitle', 'City', 'Career', 'career_role_id', 'city_id', 'keywords', 'get_keywords', 'get_location', 'get_role_name','meta_description','meta_keyword'));
        } 
        else 
        {
            return GET404VIEW();
        }
    }
}
