<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    protected $table = 'teams';

    public function sport(){
        return $this->hasOne('App\Sports', 'id', 'sports_id');
    }

    public function players(){
        return $this->hasMany('App\Players', 'team_id', 'id');
    }
}
