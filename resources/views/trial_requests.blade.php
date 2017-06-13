@extends('layouts.layout')

@section('title')
    <title>Trial Requests - UOLSports</title>
@endsection

@section('content')
    <div class="main">
        @include('sidebar')

        <div class="content col-xs-12 col-sm-12 col-md-9 col-lg-9">
            <div class="page-header">
                <h3>
                    Trial Requests
                </h3>
            </div>

            @if($requests->count())

                @foreach($requests as $request)
                    <h4>
                        You've requested to take part in {{$request->sport->name}}
                        <br>
                        <small>{{$request->created_at->diffForHumans()}}</small>
                    </h4>

                @endforeach

                @else
                <h4>
                    No pending requests
                </h4>

            @endif
        </div>
    </div>
@endsection