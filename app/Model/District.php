<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function province()
    {
        return $this->belongsTo('App\Model\Province', 'province_id');
    }
    public function city()
    {
        return $this->belongsTo('App\Model\City', 'city_id');
    }
}
