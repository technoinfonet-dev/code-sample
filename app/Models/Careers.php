<?php

namespace App\Models;

use Crypt;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Validator;
use Yajra\Datatables\Datatables;

class Careers extends Model
{
    //
    protected $table         = 'careers';
    protected $guarded       = ['id'];
    const STATUS_ACTIVE      = '1';
    const STATUS_INACTIVE    = '0';

    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source'   => 'title',
                'onUpdate' => true,
            ],
        ];
    }

    /**
     * set relationship with country
     * @author kunj
     * @return JSON Response
     **/
    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }

    /**
     * get carrer from id Module Data
     * @author Kunj
     * @param $id
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getCareers($id)
    {
        $url = GETSEGMENT(1);
        $data = self::with(['country'])
                    ->whereHas('country',function($query) use ($url){
                        $query->where('sortname',$url);
                    })->find($id);
        return $data;
    }

}
