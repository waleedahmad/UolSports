@extends('layouts.layout')

@section('title')
    <title>UOLSports</title>
@endsection

@section('content')
    <div class="main">
        @include('sidebar')

        <div class="content col-xs-12 col-sm-12 col-md-9 col-lg-9">
            <div class="page-header">
                <h3>
                    Events
                </h3>
            </div>

            <div class="events">
                @if($events->count())
                    @foreach($events as $event)
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
                    <h4>
                        No pending requests
                    </h4>

                @endif
            </div>
        </div>
    </div>
@endsection