@extends('layouts.layout')

@section('title')
    <title>Trials - UOLSports</title>
@endsection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="content col-xs-12 col-sm-9 col-md-9 col-lg-10">
            <div class="page-header">
                <h3>Trails</h3>
            </div>

            @if($trials->count())
                <div class="trials col-xs-8">
                    <table class="table">
                        <thead>
                        <th>
                            Picture
                        </th>

                        <th>
                            Name
                        </th>

                        <th>
                            Registration ID
                        </th>

                        <th>
                            Sport
                        </th>

                        <th>
                            Trial Timing
                        </th>

                        <th>
                            Created at
                        </th>

                        <th>
                            Actions
                        </th>
                        </thead>

                        <tbody>
                        @foreach($trials as $trial)
                            <tr class="trial" data-id="{{$trial->id}}">
                                <td>
                                    <a target="_blank" href="/storage/{{$trial->user->image_uri}}">
                                        <div class="image-holder">
                                            <img src="/storage/{{$trial->user->image_uri}}" alt="">
                                        </div>
                                    </a>
                                </td>

                                <td>
                                    {{$trial->user->name}}
                                </td>

                                <td>
                                    {{$trial->user->registration_id}}
                                </td>

                                <td>
                                    {{$trial->sport->name}}
                                </td>

                                <td>
                                    {{$trial->trial_timing->diffForHumans()}}
                                </td>

                                <td>
                                    {{$trial->created_at->diffForHumans()}}
                                </td>

                                <td>
                                    <button class="btn btn-default assign-team" data-id="{{$trial->id}}">Assign Team</button>
                                    <button class="btn btn-danger reject-player" data-id="{{$trial->id}}">Reject Player</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                No scheduled trials found.
            @endif
        </div>
    </div>
@endsection