@extends('layouts.layout')

@section('title')
    <title>Teams - UOLSports</title>
@endsection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="content col-xs-12 col-sm-9 col-md-9 col-lg-10">
            <div class="page-header">
                <h3>Teams</h3>

                <a href="/admin/teams/add">
                    <button class="btn btn-danger pull-right">Add Teams</button>
                </a>
            </div>

            @if($teams->count())
                <div class="teams col-xs-8">
                    <table class="table">
                        <thead>
                        <th>
                            Name
                        </th>

                        <th>
                            Sport
                        </th>

                        <th>
                            Department
                        </th>

                        <th>
                            Players Count
                        </th>

                        <th>
                            Created
                        </th>

                        <th>
                            Actions
                        </th>
                        </thead>

                        <tbody>
                        @foreach($teams as $team)
                            <tr class="team" data-id="{{$team->id}}">
                                <td>
                                    {{$team->name}}
                                </td>

                                <td>
                                    {{$team->sport->name}}
                                </td>

                                <td>
                                    {{$team->department}}
                                </td>

                                <td>
                                    {{$team->players->count()}}
                                </td>

                                <td>
                                    {{$team->created_at->diffForHumans()}}
                                </td>

                                <td>
                                    <a href="/admin/teams/edit/{{$team->id}}">
                                        <button class="btn btn-default edit-team" data-id="{{$team->id}}">Edit</button>
                                    </a>
                                    <button class="btn btn-default delete-team" data-id="{{$team->id}}">Delete</button>
                                    <button class="btn btn-danger players-list" data-id="{{$team->id}}">Players List</button>
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