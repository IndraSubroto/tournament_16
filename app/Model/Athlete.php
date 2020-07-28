<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    protected $fillable = [
        'user_id','team_id','tournament_id','first','last',
    ];

    public function team()
    {
        return $this->belongsTo('App\Model\Team', 'team_id');
    }
    public function tournament()
    {
        return $this->belongsTo('App\Model\Tournament', 'tournament_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
