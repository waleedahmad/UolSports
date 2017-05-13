@extends('layouts.layout')

@section('title')
    <title>Events - UOLSports</title>
@endsection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="content col-xs-12 col-sm-9 col-md-9 col-lg-10">
            <div class="page-header">
                <h3>Event</h3>

                <a href="/admin/events/create">
                    <button class="btn btn-danger pull-right">Create Event</button>
                </a>
            </div>

            @if($events->count())
                <div class="events col-xs-8">
                    <table class="table">
                        <thead>
                        <th>
                            Sport
                        </th>

                        <th>
                            Team One
                        </th>

                        <th>
                            Team Two
                        </th>

                        <th>
                            Event Time
                        </th>

                        <th>
                            Winner
                        </th>

                        <th>
                            Actions
                        </th>
                        </thead>

                        <tbody>
                        @foreach($events as $event)
                            <tr class="event">
                                <td>
                                   {{$event->sport->name}}
                                </td>

                                <td>
                                    {{$event->teamOne->name}}
                                </td>

                                <td>
                                    {{$event->teamTwo->name}}
                                </td>

                                <td>
                                    {{$event->event_time->diffForHumans()}}
                                </td>

                                <td>
                                    @if($event->result)
                                        Announced
                                    @else
                                        N/A
                                    @endif
                                </td>

                                <td>
                                    <a href="/admin/events/{{$event->id}}/edit">
                                        <button class="btn btn-default" data-id="{{$event->id}}">Edit</button>
                                    </a>
                                    <button class="btn btn-default delete-event" data-id="{{$event->id}}">Delete</button>

                                    <a href="/admin/events/{{$event->id}}/results">
                                        <button class="btn btn-danger event-results" data-id="{{$event->id}}">Results</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                No users found.
            @endif
        </div>
    </div>
@endsection