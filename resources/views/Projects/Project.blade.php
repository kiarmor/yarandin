
@extends('layouts.app')

@section('title', 'Project')

@section('content')

    <p> Now you are in project: <b>{{$project->project_name}}</b></p>

    <a>Create new task</a>
    <form action="/tasks" method="POST">
        @csrf
        <input type="text" name="task" placeholder="Task" class="form-control">
        <input name="projectId" value="{{$project->id}}" hidden>
        <input type="submit" class="btn btn-success" value="Create">
    </form>

    <p>Your tasks</p>
    <table class="table">
        <thead>
        <th>ID</th>
        <th>Task</th>
        <th>Status</th>
        <th>Project ID</th>
        <th>Change status</th>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                <td>{{$task->id}}</td>
                <td>{{$task->task}}</td>
                <td>{{$task->status}}</td>
                <td>{{$project->id}}</td>
                <td>
                    <form action="/tasks/{{$task->id}}" method="POST">
                        @method ('PATCH')
                        @csrf

                        <select name="status">
                            <option value="New">New</option>
                            <option value="In progress"> In progress</option>
                            <option value="Done">Done</option>
                            </select>
                        <input type="submit" value="Submit">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>



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
