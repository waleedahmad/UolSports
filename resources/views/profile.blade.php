@extends('layouts.layout')

@section('title')
    <title>{{$user->name}} - UOLSports</title>
@endsection

@section('content')
    <div class="main">
        <div class="container content profile">
            <div class="header">
                <div class="col-xs-2">
                    <div class="image-holder">
                        <img src="/storage/{{$user->image_uri}}">
                    </div>
                </div>

                <div class="col-xs-10">
                    <div class="name">
                        <h2>
                            {{$user->name}}
                        </h2>
                        <div class="reg-id">
                            {{$user->registration_id}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="feed">
                <div class="col-xs-2 sports">
                    <h3>
                        @if($user->gender === 'male') His @else Her @endif Sports
                    </h3>
                    @if($user->getParticipatingSports())
                        @foreach($user->getParticipatingSports() as $sport)
                            <div class="sport">
                                {{$sport->name}}
                            </div>
                        @endforeach
                    @else
                        No Sports
                    @endif
                </div>

                <div class="col-xs-10 activity">
                    <h3>
                        Activity
                    </h3>

                    <div class="event">

                        <div class="events">
                            @if($user->events()->count())
                                @foreach($user->events() as $event)
                                    <div class="event">
                                        <h2>
                                            {{$event->sport->name}}
                                            <br>
                                        </h2>
                                        <h4>
                                            <b>{{$event->teamOne->name}}</b> VS <b>{{$event->teamTwo->name}}</b>
                                        </h4>

                                        @if($event->results)
                                            <h4>
                                                @if($event->teamOne->id === $event->results->winner_team)
                                                    {{$event->teamOne->name}} Won
                                                @else
                                                    {{$event->teamTwo->name}} Won
                                                @endif

                                            </h4>
                                        @endif

                                        <p>
                                            {{$event->event_time->diffForHumans()}}
                                        </p>
                                    </div>

                                @endforeach

                            @else
                                No activity
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection