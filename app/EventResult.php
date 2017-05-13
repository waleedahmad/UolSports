<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventResult extends Model
{
    protected $table = 'event_result';

    public function winner(){
        return $this->hasOne('App\Teams', 'id', 'winner_team');
    }
}
