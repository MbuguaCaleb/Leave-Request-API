<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class leaverequest extends Model
{



    //Fillables
    protected $fillable = [
        'request_reason',  'admin_feedback', 'starting_date', 'ending_date', 'user_id', 'approval_status'
    ];





    //Relationship between leave request and user
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
