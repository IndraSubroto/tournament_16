<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * Fillable attribute.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'team_id',
        'tournament_id',
        'user_name',
        'user_email',
        'payment_type',
        'amount',
    ];
 
    /**
     * Set status to Pending
     *
     * @return void
     */
    public function setPending()
    {
        $this->attributes['status'] = 'pending';
        self::save();
    }
 
    /**
     * Set status to Success
     *
     * @return void
     */
    public function setSuccess()
    {
        $this->attributes['status'] = 'success';
        self::save();
    }
 
    /**
     * Set status to Failed
     *
     * @return void
     */
    public function setFailed()
    {
        $this->attributes['status'] = 'failed';
        self::save();
    }
 
    /**
     * Set status to Expired
     *
     * @return void
     */
    public function setExpired()
    {
        $this->attributes['status'] = 'expired';
        self::save();
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    
    public function team()
    {
        return $this->belongsTo('App\Model\Team','team_id');
    }
    
    public function tournament()
    {
        return $this->belongsTo('App\Model\Tournament','tournament_id');
    }
}
