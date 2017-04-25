@extends('layouts.layout')

@section('title')
    <title>Trial Requests - UOLSports</title>
@endsection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="content col-xs-12 col-sm-9 col-md-9 col-lg-10">
            <div class="page-header">
                <h3>Trial Requests</h3>
            </div>

            @if($trial_requests->count())
                <div class="users col-xs-8">
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
                            Actions
                        </th>
                        </thead>

                        <tbody>
                        @foreach($trial_requests as $request)
                            <tr class="request">
                                <td>
                                    <a target="_blank" href="/storage/{{$request->user->image_uri}}">
                                        <div class="image-holder">
                                            <img src="/storage/{{$request->user->image_uri}}" alt="">
                                        </div>
                                    </a>
                                </td>

                                <td>
                                    {{$request->user->name}}
                                </td>

                                <td>
                                    {{$request->user->registration_id}}
                                </td>

                                <td>
                                    {{$request->sport->name}}
                                </td>

                                <td>
                                    {{$request->user->created_at}}
                                </td>

                                <td>
                                    <button class="btn btn-default schedule-trial" data-id="{{$request->id}}">Schedule Trial</button>
                                    <button class="btn btn-danger delete-trial-request" data-id="{{$request->id}}">Cancel Request</button>
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