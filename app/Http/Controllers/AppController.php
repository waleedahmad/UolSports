<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function getIndex(){
        return view('index')->with(
            'your_sports', Auth::user()->getParticipatingSports()
        )->with(
            'other_sports' , Auth::user()->getOtherSports()
        );
    }

    public function getTrialRequests(){
        return view('trial_requests')->with(
            'your_sports', Auth::user()->getParticipatingSports()
        )->with(
            'other_sports' , Auth::user()->getOtherSports()
        );
    }
}
