<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public function ditrict()
    {
        return $this->hasMany('App\Model\District', 'province_id');
    }

    public function city()
    {
        return $this->hasMany('App\Model\City', 'province_id');
    }
}
