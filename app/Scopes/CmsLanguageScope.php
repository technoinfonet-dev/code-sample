<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CmsLanguageScope implements Scope
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
        if(env('MULTILINGUAL') && getDefaultLanguage()!='en' && \Request::route()->getName()!='admin.cms.edit')
        {
            //pre($model);
            $builder->addSelect(
            \DB::raw("
                IF(
                (SELECT cms_title FROM translations WHERE cms_id=cms.id AND lang_code='".getDefaultLanguage()."')  IS NULL,
                title,
                (SELECT cms_title FROM translations WHERE cms_id=cms.id AND lang_code='".getDefaultLanguage()."')
                ) as title"),
            \DB::raw("
                IF(
                (SELECT cms_long_description FROM translations WHERE cms_id=cms.id AND lang_code='".getDefaultLanguage()."')  IS NULL,
                long_description,
                (SELECT cms_long_description FROM translations WHERE cms_id=cms.id AND lang_code='".getDefaultLanguage()."')
                ) as long_description"),
            "cms.id","cms.parent_id","cms.module_id","cms.secondary_title","cms.short_description","cms.url","cms.display_on_header","cms.display_on_footer","cms.image","cms.other_parameters","cms.country_id","cms.display_order","cms.status");    
        }
        //pre(session()->all());
        //$builder->where('age', '>', 200);
    }
}