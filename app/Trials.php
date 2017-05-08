<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Trials extends Model
{
    protected $table = 'trials';

    protected $dates = ['trial_timing'];

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function sport(){
        return $this->hasOne('App\Sports', 'id', 'sports_id');
    }
}
