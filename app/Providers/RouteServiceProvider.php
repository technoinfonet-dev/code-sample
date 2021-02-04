<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {   
        $segment =\Request::segment(1);
        if ($segment == "api" && $segment !=null) {

            $this->mapApiRoutes();
            
        }else{

            $this->mapWebRoutes();
        }


        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {   
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
        // Route::namespace($this->namespace)
             // ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {   
        $countrCode =\Request::segment(2);
        $countrCode = isset($countrCode) && $countrCode == 'za' ? "sf" : $countrCode;
        $country = \App\Models\Country::select('sortname','status')->where('status','1')->pluck('sortname')->toArray();
         if (in_array($countrCode, $country)) {
            $countrCode =$countrCode;
         }else{
            $countrCode = env('DEFAULT_COUNTRY');
         }
         // dd($countrCode);
        Route::prefix('api/'.$countrCode)
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
