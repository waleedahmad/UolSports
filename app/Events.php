<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';

    protected $dates = ['event_time'];

    public function sport(){
        return $this->hasOne('App\Sports', 'id', 'sports_id');
    }

    public function teamOne(){
        return $this->hasOne('App\Teams', 'id', 'team_1');
    }

    public function teamTwo(){
        return $this->hasOne('App\Teams', 'id', 'team_2');
    }

    public function result(){
        return $this->hasOne('App\EventResult', 'id', 'winner_team');
    }
}
