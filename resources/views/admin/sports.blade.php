@extends('layouts.layout')

@section('title')
    <title>Sports - UOLSports</title>
@endsection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="content col-xs-12 col-sm-9 col-md-9 col-lg-10">
            <div class="page-header">
                <h3>Sports</h3>
            </div>

            <div class="sports">
                @foreach($sports as $sport)
                    <div class="form-group">
                        <input type="checkbox" class="sport-checkbox" value="{{$sport->name}}" @if($sport->enabled) checked @endif>
                        <span>{{$sport->name}}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection