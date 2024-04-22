@extends("layouts.layout")

@section("content")
    @include("includes.form",["task" => $task])
@endsection
