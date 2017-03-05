<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerificationRequest extends Model
{
    protected $table = 'verification_requests';

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
