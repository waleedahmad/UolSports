<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrialRequests extends Model
{
    protected $table = 'trial_requests';

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function sport(){
        return $this->hasOne('App\Sports', 'id', 'sports_id');
    }
}
