@extends('layouts.layout')

@section('title')
    <title>
        Login - UOLSports
    </title>
@endsection

@section('content')
    <div class="auth col-xs-12 col-sm-12 col-md-8 col-lg-5">
        <form action="/login" method="POST">
            <div class="form-group @if($errors->has('email')) has-error @endif">
                <label for="email">Email Address</label>
                <input type="text" class="form-control" name="email" placeholder="Email Address">
                @if($errors->has('email'))
                    {{$errors->first('email')}}
                @endif
            </div>

            <div class="form-group @if($errors->has('password')) has-error @endif">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
                @if($errors->has('password'))
                {{$errors->first('password')}}
                @endif
            </div>

            @if(Session::has('message'))
                <div class="form-group">
                    <div class="alert alert-info">
                        {{Session::get('message')}}
                    </div>
                </div>
            @endif
            {{csrf_field()}}
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
@endsection