<?php

namespace App\Http\Controllers;

use App\User;
use App\VerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Show verification requests
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $requests = VerificationRequest::all();
        return view('admin.requests')->with('requests', $requests);
    }

    /**
     * Approve verification requests
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function approveUser(Request $request){
        $v_request = VerificationRequest::find($request->req_id);

        $old_file_path = $this->getFileNameFromPath($v_request->card_uri);

        $options = [
            'verified'  =>  1,
            'card_uri'  =>  '/id_card/'.$old_file_path,
            'registration_id' => $v_request->registration_id
        ];

        $user_update = User::where('id','=', $v_request->user_id)->update($options);

        if($user_update){
            if($v_request->delete()){
                if(Storage::disk('public')->move('requests/'.$old_file_path,  'id_card/'.$old_file_path)){
                    return response()->json([
                        'approved'  => true
                    ]);
                }
            }
        }
        return response()->json([
            'approved'  =>  false
        ]);
    }

    /**
     * Disapprove verification requests
     */
    public function disapproveUser(Request $request){

        $v_request = VerificationRequest::find($request->req_id);
        $request_file_name = $this->getFileNameFromPath($v_request->card_uri);

        if($v_request->delete()){
            if(Storage::disk('public')->delete('requests/'.$request_file_name)){
                return response()->json([
                    'disapproved'  => true
                ]);
            }
        }
    }

    public function getUsers(){
        return view('admin.users');
    }

    public function getSports(){
        return view('admin.sports');
    }

    public function getPlayers(){
        return view('admin.players');
    }

    public function getSportsJoinRequests(){
        return view('admin.trial_requests');
    }

    public function getTrials(){
        return view('admin.trials');
    }

    public function getTeams(){
        return view('admin.teams');
    }

    public function getEvents(){
        return view('admin.events');
    }

    public function getFileNameFromPath($path){
        return basename($path);
    }
}
