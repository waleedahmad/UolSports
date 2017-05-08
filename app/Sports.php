<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Sports extends Model
{
    protected $table = 'sports';

    public function requestPending(){
        return TrialRequests::where('user_id', '=', Auth::user()->id)
                    ->where('sports_id','=', $this->id)->count();
    }

    public function awaitTrial(){
        return Trials::where('user_id', '=', Auth::user()->id)
            ->where('sports_id','=', $this->id)->count();
    }
}
