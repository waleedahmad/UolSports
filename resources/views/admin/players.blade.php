@extends('layouts.layout')

@section('title')
    <title>Players - UOLSports</title>
@endsection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="content col-xs-12 col-sm-9 col-md-9 col-lg-10">
            <div class="page-header">
                <h3>Players</h3>
            </div>
        </div>
    </div>
@endsection