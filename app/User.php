<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getTeamIds(){
        return Players::where('user_id','=', $this->id)->get()->pluck('team_id')->toArray();
    }

    public function getSportIds(){
        return Teams::whereIn('id', $this->getTeamIds())->get()->pluck('sports_id')->toArray();
    }

    public function getParticipatingSports(){
        return Sports::whereIn('id', $this->getSportIds())->get();
    }

    public function getOtherSports(){
        return Sports::whereNotIn('id', $this->getSportIds())
		        ->where('enabled','=', true)->get();
    }
}
