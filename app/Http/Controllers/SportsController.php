<?php

namespace App\Http\Controllers;

use App\TrialRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SportsController extends Controller
{
    public function requestTrial(Request $request){
        $sport_id = $request->sport_id;

        $trial_request = new TrialRequests();
        $trial_request->sports_id = $sport_id;
        $trial_request->user_id = Auth::user()->id;

        if($trial_request->save()){
            return response()->json([
                'created'   =>  true
            ]);
        }
        return response()->json([
            'created'   =>  false
        ]);
    }
}
