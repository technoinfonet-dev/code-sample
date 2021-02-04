<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CityLanguageScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        //pre(getDefaultLanguage());
        if(env('MULTILINGUAL') && getDefaultLanguage()!='en' && \Request::route()->getName()!='admin.cities.edit')
        {
            //pre($model);
            $builder->addSelect(\DB::raw("
                IF(
                (SELECT city_name FROM translations WHERE city_id=cities.id AND lang_code='".getDefaultLanguage()."')  IS NULL,
                name,
                (SELECT city_name FROM translations WHERE city_id=cities.id AND lang_code='".getDefaultLanguage()."')
                ) as name"),"cities.id","cities.slug","cities.city_id","cities.country_id","cities.sortname","cities.latitude","cities.longitude","cities.status");    
        }
        //pre(session()->all());
        //$builder->where('age', '>', 200);
    }
}