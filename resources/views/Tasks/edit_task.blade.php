@extends('layouts.app')

@section('title', 'Project')

@section('content')
    <h1 class="h1">Edit task</h1>



    <form method="POST" action="/tasks/{{$task->id}}">
        @method('PATCH')
        @csrf

        <div class="field">
            <label class="label" for="task">Task</label>

            <div class="control">
                <input type="text" class="input" name="task" placeholder="task" value="{{$task->task}}">
            </div>
        </div>


        <select name="status">
            <option value="New">New</option>
            <option value="In progress"> In progress</option>
            <option value="Done">Done</option>
        </select>

        <div class="field">

            <div class="control">
                <button type="submit" class="button is-link">Update </button>
            </div>
        </div>

    </form>
@endsection
