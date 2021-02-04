<?php

namespace App\Models;

use App\Models\Seo;
use Cache;
use Crypt;
use Cviebrock\EloquentSluggable\Sluggable;
use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Input;
use Validator;
use Yajra\Datatables\Datatables;
use App\Scopes\CmsLanguageScope;

class Cms extends Model
{
    use Notifiable;

    protected $table = 'cms';

    protected $guarded          = ['id'];
    const STATUS_ACTIVE         = '1';
    const STATUS_INACTIVE       = '0';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CmsLanguageScope);
    }
    
    /**
     * set relationship with seo
     *
     * @return JSON Response
     * @author kunj
     **/
    public function seo()
    {
        return $this->hasOne('App\Models\Seo', "parent_id", "id")->where("parent_table", "cms");
    }

    /**
     * set relationship with city
     *
     * @return JSON Response
     * @author kunj
     **/
    public function city()
    {
        return $this->belongsTo('App\Models\City', "city_id", "id");
    }

    /**
     * set relationship with country
     *
     * @return JSON Response
     * @author kunj
     **/
    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }

    /**
     * Get CMS Data
     *
     * @param $country string
     * @author kunj
     * @return array
     */
    public function getCMS($country=NULL)
    {
        return self::with(['seo'=>function($query){
            $query->where('status',\App\Models\Seo::STATUS_ACTIVE);
        }])->select('id', 'title', 'secondary_title', 'url', 'long_description')
        ->where('title',"Career")
        ->where('country_id',$country)
        ->where('status',self::STATUS_ACTIVE)
        ->first();
    }    
}
