<?php

namespace App\Http\Controllers;

use App\VerificationRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){

        $requests = VerificationRequest::all();
        return view('admin.requests')->with('requests', $requests);
    }

    public function getPlayers(){
        return view('admin.players');
    }

    public function getTeams(){
        return view('admin.teams');
    }

    public function getTrials(){
        return view('admin.trials');
    }

    public function getTrialRequests(){
        return view('admin.trial_requests');
    }

    public function getEvents(){
        return view('admin.events');
    }

    public function getMatches(){
        return view('admin.matches');
    }
}
