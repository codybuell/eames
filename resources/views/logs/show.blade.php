@extends('_layouts.default')

@section('head')
  <title>Page Title</title>
  <meta name="description" content="Page Title" />
  <meta name="keywords" content="Page Title" />
  <meta name="author" content="" />
@stop

@section('content')
  <div class="mark_title">{{ $title }}</div>
  <div class="mark_content">{{ $content }}</div>
@stop
