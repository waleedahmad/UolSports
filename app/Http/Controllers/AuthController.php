<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getLogin(){
        return view('auth.login');
    }

    public function getRegister(){
        return view('auth.register');
    }

    public function registerUser(Request $request){
        $rules = [
            'name'  => 'required',
            'email' =>  'required|email|unique:users',
            'password'  =>  'required|min:6',
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

    public function createUser($input){
        $user = new User();
        $user->name = $input->name;
        $user->email = $input->email;
        $user->password = bcrypt($input->password);
        $user->registration_id = '';
        $user->image_uri = '';
        $user->card_uri = '';
        $user->type = 'user';
        return $user->save();
    }

    public function authenticateUser(Request $request){

    }

    public function validateInput($input, $rules){
        return (Validator::make($input, $rules));
    }
}
