<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name','tournament_id','user_id',
    ];
    public function tournament()
    {
        return $this->belongsTo('App\Model\Tournament', 'tournament_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function payment()
    {
        return $this->hasOne('App\Model\Payment', 'team_id');
    }
    
    public function athlete()
    {
        return $this->hasMany('App\Model\Athlete', 'team_id');
    }
}
