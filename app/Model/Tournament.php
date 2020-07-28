<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = [
        'title','description','fee','pricePool','slot','dateRegisLimit','dateInitial','dateFinal','user_id','athlete',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function district()
    {
        return $this->belongsTo('App\Model\district', 'district_id');
    }

    public function team()
    {
        return $this->hasMany('App\Model\Team', 'tournament_id');
    }
}
