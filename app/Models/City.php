<?php

namespace App\Models;

use Crypt;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Validator;
use Yajra\Datatables\Datatables;
use App\Scopes\CityLanguageScope;

class City extends Model
{
    protected $table = 'cities';

    protected $guarded    = ['id'];
    const STATUS_ACTIVE   = '1';
    const STATUS_INACTIVE = '0';

    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source'   => 'name',
                'onUpdate' => true,
            ],
        ];
    }
    /**
     * set relationship with country
     *
     * @return JSON Response
     * @author kunj
     **/
    public function parent()
    {
        return $this->belongsTo('App\Models\Country', "parent_id", "id");
    }

    /**
     * set relationship with Module
     *
     * @return JSON Response
     * @author kunj
     **/
    public function module()
    {
        return $this->belongsTo('App\Models\Module', "module_id", "id");
    }
    
    /**
     * set relationship with multiple country
     *
     * @return JSON Response
     * @author kunj
     **/
    public function CountryName()
    {
        return $this->hasMany('App\Models\Country', "id", "country_id");
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CityLanguageScope);
    }
    
    /**
     * set relationship with sinlge country
     *
     * @return JSON Response
     * @author kunj
     **/
    public function SingleCountry()
    {
        return $this->belongsTo('App\Models\Country', "country_id", "id");
    }

    /**
     * Get city records
     *
     * @author kunj
     */
    public function getCityData()
    {
        return self::select('id', 'slug', 'name')->where('status', self::STATUS_ACTIVE)->where('country_id', $country)->orderBy('name', "ASC")->get();
    }
    
}
