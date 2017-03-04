@extends('layouts.layout')

@section('title')
    <title>
        User Verification - UOLSports
    </title>
@endsection

@section('content')
    <form class="form-horizontal auth col-xs-12 col-sm-12 col-md-8 col-lg-6" action="/verification" method="POST" enctype="multipart/form-data">

        <div class="form-group @if($errors->has('registration_id')) has-error @endif">
            <label class="col-sm-3 control-label">Registration ID</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="registration_id" placeholder="Registration ID">
                @if($errors->has('registration_id'))
                    {{$errors->first('registration_id')}}
                @endif
            </div>

        </div>

        <div class="form-group @if($errors->has('id_card')) has-error @endif">
            <label class="col-sm-3 control-label">University Card</label>
            <div class="col-sm-9">
                <input type="file" name="id_card">
                <p class="help-block">Upload a clear copy of your university card.</p>
                @if($errors->has('id_card'))
                    {{$errors->first('id_card')}}
                @endif
            </div>
        </div>

        @if(Session::has('message'))
            <div class="form-group @if($errors->has('id_card')) has-error @endif">
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-9">
                    <div class="alert alert-info">
                        {{Session::get('message')}}
                    </div>
                </div>
            </div>
        @endif

        {{csrf_field()}}

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
@endsection