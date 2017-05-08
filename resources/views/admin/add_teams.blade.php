@extends('layouts.layout')

@section('title')
    <title>Add Teams - UOLSports</title>
@endsection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="content col-xs-12 col-sm-9 col-md-9 col-lg-10">
            <div class="page-header">
                <h3>Add Teams</h3>
            </div>

            <div class="add-teams col-xs-8">
                <form method="POST" action="/admin/teams/add">
                    <div class="form-group @if($errors->has('team_name')) has-error @endif">
                        <label>Team Name</label>
                        <input type="text" class="form-control" name="team_name" placeholder="Team Name">
                        @if($errors->has('team_name'))
                            {{$errors->first('team_name')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('sports_id')) has-error @endif">
                        <label>Sport</label>
                        <select name="sports_id" class="form-control">
                            <option value="">Select Sport</option>
                            @foreach($sports as $sport)
                                <option value="{{$sport->id}}">{{$sport->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('sports_id'))
                            {{$errors->first('sports_id')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('department_name')) has-error @endif">
                        <label>Department</label>
                        <select name="department_name" class="form-control">
                            <option value="">Select Department</option>
                            <option value="Department of Computer Science & IT">Department of Computer Science & IT</option>
                            <option value="Department of Technology">Department of Technology</option>
                            <option value="Department of Mechanical Engineering">Department of Mechanical Engineering</option>
                            <option value="Department of Electronics & Electrical System">Department of Electronics & Electrical System</option>
                            <option value="Department of Electrical Engineering">Department of Electrical Engineering</option>
                            <option value="Department of Civil Engineering">Department of Civil Engineering</option>
                            <option value="School of Creative Arts">School of Creative Arts</option>
                            <option value="Physics">Physics</option>
                            <option value="Mathematics and Statistics">Mathematics and Statistics</option>
                            <option value="Economics">Economics</option>
                            <option value="Architecture">Architecture</option>
                            <option value="University Institute of Medical Lab Technology">University Institute of Medical Lab Technology</option>
                            <option value="University Institute of Diet & Nutritional Sciences">University Institute of Diet & Nutritional Sciences</option>
                            <option value="University Institute of Public Health">University Institute of Public Health</option>
                            <option value="University Institute of Physical Therapy">University Institute of Physical Therapy</option>
                            <option value="Radiological Sciences and Medical Imaging Technology">Radiological Sciences and Medical Imaging Technology</option>
                            <option value="Lahore School of Nursing & Midwifery">Lahore School of Nursing & Midwifery</option>
                            <option value="College of LAW">College of LAW</option>
                            <option value="English Language & Literature">English Language & Literature</option>
                            <option value="Lahore Business School">Lahore Business School</option>
                            <option value="University College of Dentistry">University College of Dentistry</option>
                            <option value="University College of Medicine">University College of Medicine</option>
                            <option value="Lahore Business School">Lahore Business School</option>
                            <option value="Department of Pharmacy">Department of Pharmacy</option>
                            <option value="Institute of Molecular Biology and Biotechnology">Institute of Molecular Biology and Biotechnology</option>
                        </select>

                        @if($errors->has('department_name'))
                            {{$errors->first('department_name')}}
                        @endif
                    </div>


                    @if(Session::has('message'))
                    <div class="form-group">
                        <div class="alert alert-info">
                            {{Session::get('message')}}
                        </div>
                    </div>
                    @endif


                    {{csrf_field()}}

                    <a href="/admin/teams" class="cancel-team" onclick="return false">
                        <button type="submit" class="btn btn-default">Cancel</button>
                    </a>
                    <button type="submit" class="btn btn-danger">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection