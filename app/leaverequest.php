<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class leaverequest extends Model
{
    //

    //Fillables
    protected $fillable = [
        'request_reason',  'decline_reason', 'starting_date', 'ending_date', 'approval_status', 'user_id'
    ];





    //Relationship between leave request and user
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
