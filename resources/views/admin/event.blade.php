@extends('layouts.layout')

@section('title')
    <title>Event - UOLSports</title>
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

            <div class="event-result">

            </div>

        </div>
    </div>
@endsection