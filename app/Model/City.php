<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function province()
    {
        return $this->belongsTo('App\Model\Province', 'province_id');
    }

    public function district()
    {
        return $this->hasMany('App\Model\District', 'city_id');
    }
}
