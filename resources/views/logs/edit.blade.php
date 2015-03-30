@extends('_layouts.fullscreen')

@section('head')
  <title>Edit Activity</title>
  <meta name="description" content="Page Title" />
  <meta name="keywords" content="Page Title" />
  <meta name="author" content="" />
@stop

@section('content')
  <div class="full_page_basic_form">
    {{ Form::model($log, array('route' => array('logs.update', $log->id), 'method' => 'PUT')) }}
      <div class="row">
        {{ Form::text('title',null,array('placeholder' => 'Title', 'class' => 'six cols')) }}
        {{ Form::text('system',null,array('placeholder' => 'System', 'class' => 'three cols')) }}
        {{ Form::select('type', $types,null,array('class' => 'three cols')) }}
      </div>
      {{ Form::textarea('content',null,array('placeholder' => 'Activity', 'class' => 'mono')) }}
      {{ Form::submit('Save') }}
    {{ Form::close() }}
  </div>
@stop
