@extends('layouts.layout')

@section('title')
    <title>
        Login - UOLSports
    </title>
@endsection

@section('content')
    <div class="auth col-xs-12 col-sm-12 col-md-8 col-lg-5">
        <form action="/login" method="POST">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" name="email" placeholder="Email Address" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
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