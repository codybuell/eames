@extends('layouts.fullscreen')

@section('head')
  <title>Create Activity Log - {{ env('SITE_NAME', 'EAMES') }}</title>
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="author" content="" />
  <meta name="og:site_name" content="" />
  <meta name="og:title" content="" />
  <meta name="og:description" content="" />
  <meta name="og:url" content="" />
@endsection

@section('style')
  <style>
  </style>
@endsection

@section('header')
  @include('partials.menubar')
@endsection

@section('content')
  <div class="full_page_basic_form">
    {!! Form::open([ 'route' => 'logs.store' ]) !!}
      <div class="row">
        <div class="col-md-5">
          {!! Form::text('title',null,['placeholder' => 'Title', 'class' => 'full']) !!}
        </div>
        <div class="col-md-4">
          {!! Form::text('system',null,['placeholder' => 'System', 'class' => 'full']) !!}
        </div>
        <div class="col-md-3">
          {!! Form::select('type', $types,null,['class' => 'full']) !!}
        </div>
      </div>
      {!! Form::textarea('content',null,['placeholder' => 'Activity', 'class' => 'mono']) !!}
      {!! Form::submit('Save') !!}
    {!! Form::close() !!}
  </div>
@endsection

@section('footer')
@endsection

@section('scripts')
  <script>
  </script>
@endsection
