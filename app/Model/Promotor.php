<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Promotor extends Model
{
    protected $fillable = [
        'user_id',
        'company',
        'phone',
        'wa',
        'instagram',
        'facebook',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
