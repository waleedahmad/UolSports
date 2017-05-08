@extends('layouts.layout')

@section('title')
    <title>Edit Teams - UOLSports</title>
@endsection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="content col-xs-12 col-sm-9 col-md-9 col-lg-10">
            <div class="page-header">
                <h3>Edit Team ({{$team->name}})</h3>
            </div>

            <div class="add-teams col-xs-8">
                <form method="POST" action="/admin/teams/update">
                    <div class="form-group @if($errors->has('team_name')) has-error @endif">
                        <label>Team Name</label>
                        <input type="text" class="form-control" name="team_name" placeholder="Team Name" value="{{$team->name}}">
                        @if($errors->has('team_name'))
                            {{$errors->first('team_name')}}
                        @endif
                    </div>

                    <input type="hidden" name="id" value="{{$team->id}}">

                    @if(Session::has('message'))
                        <div class="form-group">
                            <div class="alert alert-info">
                                {{Session::get('message')}}
                            </div>
                        </div>
                    @endif

                    {{csrf_field()}}

                    <a href="/admin/teams" class="cancel-team" onclick="return false">
                        <button type="submit" class="btn btn-default">Cancel</button>
                    </a>
                    <button type="submit" class="btn btn-danger">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection