@extends('layouts.layout')

@section('title')
    <title>Users - UOLSports</title>
@endsection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="content col-xs-12 col-sm-9 col-md-9 col-lg-10">
            <div class="page-header">
                <h3>Users</h3>
            </div>

            @if($users->count())
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
                            Registered at
                        </th>

                        <th>
                            Actions
                        </th>
                        </thead>

                        <tbody>
                        @foreach($users as $user)
                            <tr class="user">
                                <td>
                                    <a target="_blank" href="/storage/{{$user->image_uri}}">
                                        <div class="image-holder">
                                            <img src="/storage/{{$user->image_uri}}" alt="">
                                        </div>
                                    </a>
                                </td>

                                <td>
                                    {{$user->name}}
                                </td>

                                <td>
                                    {{$user->registration_id}}
                                </td>

                                <td>
                                    {{$user->created_at}}
                                </td>

                                <td>
                                    <button class="btn btn-danger delete-user" data-id="{{$user->id}}">Delete</button>
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