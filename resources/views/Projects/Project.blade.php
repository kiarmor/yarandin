
@extends('layouts.app')

@section('title', 'Project')

@section('content')

You now in project: <b>{{$project->project_name}}</b>



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
