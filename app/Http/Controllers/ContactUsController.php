<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Models\Cms;
use App\Models\Inquiry;

class ContactUsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->contactObj   = new Inquiry;
        $this->cmsObj       = new Cms;
    }
    
    /**
     * Display contact us page.
     * @return view
     * @author Kunj
     */
    public function getContactUs()
    {   
        $country = GET_COUNTRY_ID_BASE_ON_SEGMENT(GETSEGMENT(1));
        
        $getPage  = $this->cmsObj->getCMSCms($country);
        
        $tabTitle = $meta_description = $meta_keyword = "";
        if ($getPage != null) {
            if($getPage->seo != null)
            {
                $tabTitle = isset($getPage->seo->seo_title) && !empty($getPage->seo->seo_title) ? $getPage->seo->seo_title : STR_TO_WORD_FOR_URL($getPage->url);
                $meta_description = isset($getPage->seo->seo_description) && !empty($getPage->seo->seo_description) ? $getPage->seo->seo_description : "";
                $meta_keyword = isset($getPage->seo->seo_keyword) && !empty($getPage->seo->seo_keyword) ? $getPage->seo->seo_keyword : "";
            }
            else
            {
                $tabTitle = STR_TO_WORD_FOR_URL($getPage->url);
            }
            return view('front.modules.contact_us.contact_us', compact('getPage', 'tabTitle','meta_description','meta_keyword'));
        } else {
            $tabTitle = trans('lang_data.page_not_found');
            return view('errors.front_outer_404', compact('tabTitle'));
        }
    }

    /**
     * Save contacts
     * @author Kunj
     * @return JSON
     */
    public function store(ContactUsRequest $request)
    {
        return $this->contactObj->saveFrontContactUs($request);
    }
}
