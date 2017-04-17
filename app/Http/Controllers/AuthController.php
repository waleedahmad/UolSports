<?php

namespace App\Http\Controllers;

use App\User;
use App\VerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Get login view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin(){
        return view('auth.login');
    }

    /**
     * Get register view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRegister(){
        return view('auth.register');
    }

    /**
     * Logout authenticated user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    /**
     * Register a new user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function registerUser(Request $request){
        $rules = [
            'name'  => 'required',
            'email' =>  'required|email|unique:users',
            'password'  =>  'required|min:6',
            'gender'    =>  'required',
            'confirm_password'  =>  'required|same:password',
        ];

        $validator = $this->validateInput($request->all(), $rules);

        if($validator->passes()){
            if($this->createUser($request)){
                $request->session()->flash('message', 'Registration Successful');
            }else{
                $request->session()->flash('message', 'Unable to register');
            }
            return redirect('/login');
        }else{
            return redirect('/register')->withErrors($validator)->withInput();
        }
    }

    /**
     * Create a new user in database
     * @param $input
     * @return bool
     */
    private function createUser($input){
        $user = new User();
        $user->name = $input->name;
        $user->email = $input->email;
        $user->password = bcrypt($input->password);
        $user->registration_id = '';
        $user->verified = 0;
        $user->image_uri = 'default/img/default_img_male.jpg';
        $user->card_uri = '';
        $user->gender = $input->gender;
        $user->type = 'user';
        return $user->save();
    }

    public function authenticateUser(Request $request){
        $rules = [
            'email' =>  'required|email',
            'password'  =>  'required'
        ];
        $validator = $this->validateInput($request->all(), $rules);

        if($validator->passes()){
            if(Auth::attempt([
                'email' =>  $request->email,
                'password'  =>  $request->password
            ], true)){
                return redirect('/');
            }else{
                $request->session()->flash('message', 'Incorrect email or password');
                return redirect('/login');
            }
        }else{
            return redirect('/login')->withErrors($validator)->withInput();
        }
    }

    /**
     * Returns validator object, take input and rules
     * @param $input
     * @param $rules
     * @return mixed
     */

    private function validateInput($input, $rules){
        return (Validator::make($input, $rules));
    }

    /**
     * Show user verification form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getVerificationForm(){
        return view('auth.verification');
    }

    /**
     * Process verification request
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function processVerification(Request $request){
        $rules = [
            'registration_id'   =>  'required|min:11|max:11|unique:users,registration_id|roll_no',
            'id_card'   =>  'required|file|mimes:jpg,jpeg,png'
        ];

        $validator = $this->validateInput($request->all(), $rules);

        if($validator->passes()){
            if($this->verificationRequestExist(Auth::user()->id)){
                $request->session()->flash('message', 'Verification request pending');
                return redirect('/verification');
            }else{
                if($this->createVerificationRequest($request)){
                    $request->session()->flash('message', 'Verification request submitted');
                    return redirect('/verification');
                }
            }
        }else{
            return redirect('/verification')->withErrors($validator)->withInput();
        }
    }

    /**
     * Create new verification request
     * @param Request $request
     * @return bool
     */
    private function createVerificationRequest(Request $request){

        $file = $request->file('id_card');
        $ext = $file->extension();
        $path = 'requests/'.str_random(10).'.'.$ext;

        if($this->uploadFile($path, $file)){
            $v_request = new VerificationRequest();
            $v_request->user_id = Auth::user()->id;
            $v_request->registration_id = $request->registration_id;
            $v_request->card_uri = $path;

            if($v_request->save()){
                return true;
            }
        }
        return false;
    }

    /**
     * Check if verification request exist
     * @param $id
     * @return mixed
     */
    private function verificationRequestExist($id){
        return VerificationRequest::where('user_id','=', $id)->count();
    }

    /**
     * Upload a file contents to a path provided
     * @param $path
     * @param $file
     * @return mixed
     */
    private function uploadFile($path, $file){
        return Storage::disk('public')->put($path,  File::get($file));
    }
}
