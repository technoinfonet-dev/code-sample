<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can rad2deg(number) egister web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::group(['middleware'=>['check_url_segment','check_business_user_country_session','xss_filtering','prevent-back-history','redirect_to_next_url','set_default_language'],'prefix' => GETSEGMENT(1)], function () {

    ///////////////////////////
    // CONTACT US PAGE ROUTE //
    ///////////////////////////
    Route::get('contact-us', 'ContactUsController@getContactUs')->name('front.contact_us');
    Route::post('contact-us/store', 'ContactUsController@store')->name('front.contact_us.store');
    ///////////////////////////////
    // CONTACT US PAGE ROUTE END //
    ///////////////////////////////

    //////////////////////
    //CAREER PAGE ROUTE //
    //////////////////////
    Route::get('career', 'CareerController@index')->name('front.career');
    Route::any('career/{slug?}', 'CareerController@index')->name('front.career_search');
    ///////////////////////////
    // CAREER PAGE ROUTE END //
    ///////////////////////////
});
