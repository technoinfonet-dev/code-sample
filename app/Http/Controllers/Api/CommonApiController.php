<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiCommonFunctionController as ApiCommonFunctionController;
use Validator;
use Auth;

class CommonApiController extends ApiCommonFunctionController
{
   	/**
     * load default constructor methods.
     * @return Response
     * @author Bhargav Upadhyay
     */
    public function __construct()
    {
        $this->objCountry = new \App\Models\Country;
    }

   	/**
   	 * [ApiGetAllCountryList This function is used to get all country list]
   	 * @author Bhargav Upadhyay
   	 */
    public function ApiGetAllCountryList(){
        return \App\Models\Country::ApiGetAllCountryList();
    }


}
