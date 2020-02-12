@extends('layout')

@section('title', 'Error')

@section('content')
    @if(isset($error))
        {{ $error }}
    @endif

@endsection