<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CategoryLanguageScope implements Scope
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
        if(env('MULTILINGUAL') && getDefaultLanguage()!='en' && \Request::route()->getName()!='admin.categories.edit')
        {
            //pre($model);
            $builder->addSelect(\DB::raw("
                IF(
                (SELECT category_title FROM translations WHERE category_id=categories.id AND lang_code='".getDefaultLanguage()."')  IS NULL,
                title,
                (SELECT category_title FROM translations WHERE category_id=categories.id AND lang_code='".getDefaultLanguage()."')
                ) as title"),"categories.id","categories.parent_id","categories.country_id","categories.image","categories.slug","categories.display_order","categories.is_approved","categories.status","categories.total_search");    
        }
        //pre(session()->all());
        //$builder->where('age', '>', 200);
    }
}