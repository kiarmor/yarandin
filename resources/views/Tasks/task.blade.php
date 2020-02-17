
@extends('layouts.app')

@section('title', 'Project')

@section('content')

    <p> Now you are in task: <b>{{$task->task}}</b></p>

    @if(!empty($task->path))
        <b>FILE</b>
        <form name="download" action="/tasks/{{$task->id}}/download">
            <div class="control">

                <button type="submit" class="button">Download</button>
            </div>
        </form>

    @endif

    <p>Here you can <b><a href="/tasks/{{$task->id}}/edit">edit</a></b>  current task and change status.</p>


    <p>Here you can <b>delete</b>  current task.</p>
    <form method="POST" action="/tasks/{{$task->id}}">
        @method('DELETE')
        @csrf

        <div class="field">

            <div class="control">
                <button type="submit" class="button">Delete </button>
            </div>
        </div>
    </form>
@endsection
