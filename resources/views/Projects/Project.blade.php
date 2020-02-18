
@extends('layouts.app')

@section('title', 'Project')

@section('content')

    <p> Now you are in project: <b>{{$project->project_name}}</b></p>

    <p>Project description: {{$project->description}}</p>

    <a>Create new task</a>
    <form action="/projects/{{$project->id}}/tasks" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="task" placeholder="Task" class="form-control">
        {{--<input name="projectId" value="{{$project->id}}" hidden>--}}
        <input type="file" name="user_file">
        <input type="submit" class="btn btn-success" value="Create">

    </form>

    <p>Your tasks:</p>

    <p> <a href="/projects/{{$project->id}}/status/New" name="status"> New </a>
        <a href="/projects/{{$project->id}}/status/In progress" name="status"> In progress </a>
        <a href="/projects/{{$project->id}}/status/Done" name="status"> Done </a>
    </p>

    <table class="table">
        <thead>
        <th>ID</th>
        <th>Task</th>
        <th>Status</th>
        <th>Project ID</th>
        <th>File</th>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                <td>{{$task->id}}</td>
                <td><a href="/projects/{{$project->id}}/tasks/{{$task->id}}">{{$task->task}}</a></td>
                <td>{{$task->status}}</td>
                <td>{{$project->id}}</td>
                <td>
                    @if(!empty($task->path))
                        File
                    @else
                        No file
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p>Here you can <b><a href="/projects/{{$project->id}}/edit">edit</a></b>  current project.</p>

    <p>Here you can delete current project: <b>{{$project->project_name}}</b></p>
    <form method="POST" action="/projects/{{$project->id}}">
        @method('DELETE')
        @csrf

        <div class="field">

            <div class="control">
                <button type="submit" class="button">Delete </button>
            </div>
        </div>
    </form>
@endsection
