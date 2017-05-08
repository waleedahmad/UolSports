<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    protected $table = 'players';

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
