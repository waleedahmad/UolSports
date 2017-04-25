@extends('layouts.layout')

@section('title')
    <title>UOLSports</title>
@endsection

@section('content')
    <div class="main">
        @include('sidebar')

        <div class="content col-xs-12 col-sm-12 col-md-9 col-lg-9">
            Content
        </div>
    </div>
@endsection