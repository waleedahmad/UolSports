@extends('layouts.layout')

@section('title')
    <title>Edit Event - UOLSports</title>
@endsection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="content col-xs-12 col-sm-9 col-md-9 col-lg-10">
            <div class="page-header">
                <h3>Edit Event</h3>
            </div>

            <div class="add-event col-xs-8" id="add-event">
                <form method="POST" action="/admin/event">
                    <div class="form-group @if($errors->has('sports_id')) has-error @endif">
                        <label>Sport</label>
                        <select id="event-sport" class="form-control" name="event_sport">
                            <option value="">Select Sport</option>
                            @foreach($sports as $sport)
                                <option value="{{$sport->id}}" @if($sport->id === $event->sports_id) selected @endif>{{$sport->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group @if($errors->has('sports_id')) has-error @endif">
                        <label>Team One</label>
                        <select id="event-sport-team1" class="form-control" name="team_one">
                            <option value="">Select Team One</option>
                            @foreach($teams as $team)
                                <option value="{{$team->id}}" @if($team->id === $event->team_1) selected @endif>{{$team->name}} - {{$team->department}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group @if($errors->has('sports_id')) has-error @endif">
                        <label>Team Two</label>
                        <select id="event-sport-team2" class="form-control" name="team_two">
                            <option value="">Select Team Two</option>
                            @foreach($teams as $team)
                                <option value="{{$team->id}}" @if($team->id === $event->team_2) selected @endif>{{$team->name}} - {{$team->department}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group @if($errors->has('sports_id')) has-error @endif">
                        <label>Event Date</label>
                        <input type="text" class="form-control" id="event-date" name="event_date" placeholder="YYYY-MM-DD" value="{{date_format(new DateTime($event->event_time), 'Y-m-d')}}">
                    </div>

                    <div class="form-group @if($errors->has('sports_id')) has-error @endif">
                        <label>Event Time</label>
                        <input type="text" class="form-control" id="event-time" name="event_time" placeholder="9:00am" value="{{date_format(new DateTime($event->event_time), 'H:i')}}" >
                    </div>

                    <input type="hidden" name="id" value="{{$event->id}}">


                    @if(Session::has('message'))
                        <div class="form-group">
                            <div class="alert alert-info">
                                {{Session::get('message')}}
                            </div>
                        </div>
                    @endif

                    <div class="form-group" id="event-errors">

                    </div>

                    {{method_field('PUT')}}
                    {{csrf_field()}}

                    <a href="/admin/events" class="cancel-team" onclick="return false">
                        <button type="submit" class="btn btn-default">Cancel</button>
                    </a>
                    <button type="submit" class="btn btn-danger">Create</button>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection