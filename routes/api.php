<?php

use Illuminate\Http\Request;
Route::group(['middleware'=>['set_default_language']], function () {
    // 1) GET ALL COUNTRY LIST 01 - November - 2019
    Route::get("ApiGetAllCountryList","Api\CommonApiController@ApiGetAllCountryList");
});


