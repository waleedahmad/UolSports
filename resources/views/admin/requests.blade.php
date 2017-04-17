@extends('layouts.layout')

@section('title')
    <title>Requests - UOLSports</title>
@endsection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="content col-xs-12 col-sm-9 col-md-9 col-lg-10">
            <div class="page-header">
                <h3>Verification Requests</h3>
            </div>

            @if($requests->count())
                <div class="requests col-xs-8">
                    <table class="table">
                        <thead>
                        <th>
                            Card
                        </th>

                        <th>
                            Name
                        </th>

                        <th>
                            Registration ID
                        </th>

                        <th>
                            Time
                        </th>

                        <th>
                            Actions
                        </th>
                        </thead>

                        <tbody>
                        @foreach($requests as $request)
                            <tr class="request">
                                <td>
                                    <a target="_blank" href="/storage/{{$request->card_uri}}">
                                        <div class="image-holder">
                                            <img src="/storage/{{$request->card_uri}}" alt="">
                                        </div>
                                    </a>
                                </td>

                                <td>
                                    {{$request->user->name}}
                                </td>

                                <td>
                                    {{$request->registration_id}}
                                </td>

                                <td>
                                    {{$request->created_at}}
                                </td>

                                <td>
                                    <button class="btn btn-default approve-user" data-id="{{$request->id}}">Accept</button>

                                    <button class="btn btn-danger disapprove-user" data-id="{{$request->id}}">Disapprove</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                No verification requests found.
            @endif
        </div>
    </div>
@endsection