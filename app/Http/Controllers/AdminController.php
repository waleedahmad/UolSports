<?php

namespace App\Http\Controllers;

use App\Players;
use App\Teams;
use Validator;
use App\Sports;
use App\TrialRequests;
use App\Trials;
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
    public function index()
    {
        $requests = VerificationRequest::all();
        return view('admin.requests')->with('requests', $requests);
    }

    /**
     * Approve verification requests
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function approveUser(Request $request)
    {
        $v_request = VerificationRequest::find($request->req_id);

        $old_file_path = $this->getFileNameFromPath($v_request->card_uri);

        $options = [
            'verified' => 1,
            'card_uri' => '/id_card/' . $old_file_path,
            'registration_id' => $v_request->registration_id
        ];

        $user_update = User::where('id', '=', $v_request->user_id)->update($options);

        if ($user_update) {
            if ($v_request->delete()) {
                if (Storage::disk('public')->move('requests/' . $old_file_path, 'id_card/' . $old_file_path)) {
                    return response()->json([
                        'approved' => true
                    ]);
                }
            }
        }
        return response()->json([
            'approved' => false
        ]);
    }

    /**
     * Disapprove verification requests
     */
    public function disapproveUser(Request $request)
    {

        $v_request = VerificationRequest::find($request->req_id);
        $request_file_name = $this->getFileNameFromPath($v_request->card_uri);

        if ($v_request->delete()) {
            if (Storage::disk('public')->delete('requests/' . $request_file_name)) {
                return response()->json([
                    'disapproved' => true
                ]);
            }
        }
    }

    public function getUsers()
    {
        $users = User::where('type', '!=', 'admin')->paginate(10);
        return view('admin.users')->with('users', $users);
    }

    public function deleteUser(Request $request){
        $user = User::find($request->id);

        if(!$this->userImageUriIsDefault($user->image_uri)){
            if($this->removeFile($user->card_uri) && $this->removeFile($user->image_uri)){
                if($user->delete()){
                    return response()->json(true);
                }
            }
        }else{
            if($this->removeFile($user->card_uri)){
                if($user->delete()){
                    return response()->json(true);
                }
            }
        }
    }

    public function userImageUriIsDefault($image_uri){
        return ($image_uri === 'default/img/default_img_male.jpg' || $image_uri === 'default/img/default_img_female.jpg');
    }

    public function removeFile($uri){
        return Storage::disk('public')->delete($uri);
    }

    public function getSports()
    {
        $sports = Sports::all();
        return view('admin.sports')->with('sports', $sports);
    }

    /**
     * Enable sport
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function enableSport(Request $request)
    {
        $sport = Sports::where('name', '=', $request->sport);

        if ($sport->update([
            'enabled' => 1
        ])
        ) {
            return response()->json([
                'enabled' => true
            ]);
        }

        return response()->json([
            'disapproved' => false
        ]);
    }

    /**
     * Disable sport
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function disableSport(Request $request)
    {
        $sport = Sports::where('name', '=', $request->sport);

        if ($sport->update([
            'enabled' => 0
        ])
        ) {
            return response()->json([
                'disabled' => true
            ]);
        }

        return response()->json([
            'disabled' => false
        ]);
    }

    /**
     * Show sport join requests
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSportsJoinRequests()
    {
        $trial_requests = TrialRequests::all();
        return view('admin.trial_requests')->with('trial_requests', $trial_requests);
    }

    /**
     * Get sport join request info
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTrialInfo(Request $request){
        $id = $request->id;

        if($request->planned === 'true'){
            $trial = Trials::with('sport')->with('user')->find($id);
            $teams = Teams::where('sports_id','=', $trial->sports_id)->get();
            return response()->json([
                'trial' =>  $trial,
                'teams' =>  $teams
            ]);
        }else{
            $trial_request = TrialRequests::with('sport')->with('user')->find($id);
            return response()->json($trial_request);
        }
    }

    /**
     * Delete sport join request
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteTrial(Request $request){
        if($request->planned === 'true'){
            $id = $request->id;

            $trial = Trials::find($id);

            if($trial->delete()){
                return response()->json(true);
            }
        }else{
            $id = $request->id;

            $trial_request = TrialRequests::find($id);

            if($trial_request->delete()){
                return response()->json(true);
            }
        }
    }

    public function processTrialRequest(Request $request){
        $id = $request->id;
        $timestamp = $request->timestamp;

        $trial_request = TrialRequests::find($id);
        $trial = new Trials();
        $trial->user_id = $trial_request->user_id;
        $trial->sports_id = $trial_request->sports_id;
        $trial->trial_timing = $timestamp;

        if($trial->save()){
            if($trial_request->delete()){
                return response()->json(true);
            }
        }
        return response()->json(false);
    }

    public function getTrials()
    {
        $trials = Trials::all();
        return view('admin.trials')->with('trials', $trials);
    }

    public function assignTeamToPlayer(Request $request){
        $team_id = $request->team_id;
        $trial_id = $request->trial_id;

        $trial = Trials::find($trial_id);

        $player = new Players();
        $player->user_id = $trial->user_id;
        $player->team_id = $team_id;

        if($player->save()){
            if($trial->delete()){
                return response()->json(true);
            }
        }
    }

    public function removePlayerFromTeam(Request $request){
        $player = Players::find($request->id);
        if($player->delete()){
            return response()->json(true);
        }
    }

    public function getTeams()
    {
        $teams = Teams::all();
        return view('admin.teams')->with('teams', $teams);
    }

    public function addTeams(){
        $sports = Sports::all();
        return view('admin.add_teams')->with('sports', $sports);
    }

    public function createTeams(Request $request){
        $validator = Validator::make($request->all(), [
            'team_name' =>  'required',
            'sports_id' =>  'required',
            'department_name'   =>  'required'
        ]);

        if($validator->passes()){
            if(!$this->teamExist($request->sports_id, $request->team_name, $request->department_name)){
                if($this->createTeam($request->sports_id, $request->team_name, $request->department_name)){
                    return redirect('/admin/teams');
                }
            }else{
                $request->session()->flash('message', 'Team already exist');
                return redirect('/admin/teams/add');
            }
        }else{
            return redirect('/admin/teams/add')->withErrors($validator);
        }
    }

    public function createTeam($sport_id, $name, $dept){
        $team = new Teams();
        $team->name = $name;
        $team->sports_id = $sport_id;
        $team->department = $dept;
        if($team->save()){
            return true;
        }
    }

    protected function teamExist($sport_id, $name, $dept){
        return Teams::where('name','=', $name)->where('sports_id','=', $sport_id)->where('department', '=', $dept)->count();
    }

    public function editTeam($id){
        $sports = Sports::all();
        $team = Teams::find($id);
        return view('admin.edit_team')->with('team', $team)->with('sports', $sports);
    }

    public function updateTeam(Request $request){
        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'team_name' =>  'required',
        ]);

        if($validator->passes()){
            $team = Teams::find($id);
            $team->name = $request->team_name;
            if($team->save()){
                return redirect('/admin/teams');
            }
        }else{
            return redirect('/admin/teams/edit/'.$id)->withErrors($validator);
        }
    }

    public function getTeamPlayers(Request $request){
        $team = Teams::with('players.user')->with('sport')->find($request->id)->toArray();

        return response()->json($team);
    }

    public function deleteTeam(Request $request){
        $team = Teams::find($request->id);

        if($team->delete()){
            return response()->json(true);
        }
    }

    public function getEvents()
    {
        return view('admin.events');
    }

    public function getFileNameFromPath($path)
    {
        return basename($path);
    }
}
