<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        ////////////////////////////////////
        //Set config to access everywhere //
        ////////////////////////////////////
        \Config::set(['constantCountry' => \App\Models\Country::where('sortname',GET_COUNTRY_CODE_FROM_URL(CHECK_API_REQUEST_OR_WEB()))->first()]);
        if(isset(\Config::get('constantCountry')->id) && \Schema::hasTable('settings_country') && \Schema::hasColumn('settings_country','top_category'))
        {
            \Config::set(['constantSite' => \App\Models\Setting::where('settings.status', \App\Models\Setting::STATUS_ACTIVE)
                    ->select('settings.*',
                    'currency',
                    'currency_keyword',
                    'address',
                    'second_address',
                    'third_address',
                    'email',
                    'second_email',
                    'third_email',
                    'top_category',
                    'phone',
                    'second_phone',
                    'third_phone',
                    'time_zone',
                    'latitude',
                    'longitude'
                )
                ->leftJoin('settings_country as sc','sc.setting_id','=','settings.id')
                ->where('sc.country_id',\Config::get('constantCountry')->id)
                ->first()]);
        }
        
        ////////////////////////////////////
        //Set config to access everywhere //
        ////////////////////////////////////
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
