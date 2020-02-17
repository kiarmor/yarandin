@extends('layouts.app')

@section('title', 'Project')

@section('content')
    <h1 class="h1">Edit project</h1>



    <form method="POST" action="/projects/{{$project->id}}">
        @method('PATCH')
        @csrf

        <div class="field">
            <label class="label" for="project_name">Project</label>

            <div class="control">
                <input type="text" class="input" name="project_name" placeholder="project_name" value="{{$project->project_name}}">
            </div>
        </div>

        <div class="field">
            <label class="label" for="description">Description</label>

            <div class="control">
                <input type="text" class="input" name="description" placeholder="description" value="{{$project->description}}">
            </div>
        </div>

        <div class="field">

            <div class="control">
                <button type="submit" class="button is-link">Update </button>
            </div>
        </div>

    </form>
@endsection
