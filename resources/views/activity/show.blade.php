@extends('layout.default')

@section('contents')
    <h1>{{ $row->title }}</h1>
    <div>{!! $row->content !!} </div>
@stop