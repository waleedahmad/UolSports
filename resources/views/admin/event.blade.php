@extends('layouts.layout')

@section('title')
    <title>Event - UOLSports</title>
@endsection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="content col-xs-12 col-sm-9 col-md-9 col-lg-10">
            <div class="page-header">
                <h3>
                    Event : {{$event->teamOne->name}} vs {{$event->teamTwo->name}}
                </h3>

                <a href="/admin/events">
                    <button class="btn btn-danger pull-right">All Events</button>
                </a>
            </div>


            <div class="event-result">
                <h3>
                    Winner Team - <span id="winner">@if($event->results) {{$event->results->winner->name}} @else N/A @endif</span>
                </h3>

                <div class="col-xs-4">
                    <select id="winner-team" class="form-control" data-event-id="{{$event->id}}">
                        <option value="" @if(!$event->results) selected @endif>Select winner team</option>
                        <option value="{{$event->team_1}}" @if($event->results) @if($event->results->winner_team === $event->team_1) selected @endif @endif>
                            {{$event->teamOne->name}} - {{$event->teamOne->department}}
                        </option>
                        <option value="{{$event->team_2}}" @if($event->results) @if($event->results->winner_team === $event->team_2) selected @endif @endif >
                            {{$event->teamTwo->name}} - {{$event->teamOne->department}}
                        </option>
                    </select>
                </div>
            </div>

        </div>
    </div>
@endsection