<?php

namespace App\Http\Controllers;

use App\Events;
use App\TrialRequests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class AppController extends Controller
{
    public function getIndex(){
        $events = Events::all();
        return view('index')->with(
            'your_sports', Auth::user()->getParticipatingSports()
        )->with(
            'other_sports' , Auth::user()->getOtherSports()
        )->with('events', $events);
    }

    public function getTrialRequests(){
        $requests = TrialRequests::where('user_id','=', Auth::user()->id)->get();
        return view('trial_requests')->with(
            'your_sports', Auth::user()->getParticipatingSports()
        )->with(
            'other_sports' , Auth::user()->getOtherSports()
        )->with('requests', $requests);
    }

    public function userProfile($id){
        $user = User::find($id);
        return view('profile')->with('user', $user);
    }
}
