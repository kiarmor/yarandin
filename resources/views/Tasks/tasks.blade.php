
@extends('layouts.app')

@section('title', 'Project')

@section('content')

    <table class="table">
        <thead>
        <th>ID</th>
        <th>Task</th>
        <th>Status</th>

        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                <td>{{$task->id}}</td>
                <td><a href="/../tasks/{{$task->id}}">{{$task->task}}</a></td>
                <td>{{$task->status}}</td>

                <td>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
