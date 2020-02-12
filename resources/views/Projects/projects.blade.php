@extends('layouts.app')

@section('title', 'Project')

@section('content')
    <div class="container">

                   <p>This is Your projects</p>


        <p><b>Create new project:</b></p>
            <form action="/projects" method="POST">
                @csrf
                <input type="text" name="project_name" placeholder="Project name" class="form-control">
                <input type="text" name="description" placeholder="Project description" class="form-control">
                <input type="submit" class="btn btn-success" value="Create">
            </form>


        <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Project name</th>
                            <th>Project Description</th>
                        </thead>
                        <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{$project->id}}</td>
                            <td><a href="/projects/{{$project->id}}">{{$project->project_name}}</a></td>
                            <td>{{$project->description}}</td>
                        </tr>
                    @endforeach
                        </tbody>
                    </table>
    </div>
@endsection
