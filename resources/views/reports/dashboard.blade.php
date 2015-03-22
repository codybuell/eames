@extends('layouts.default')

@section('head')
  <title>Users - {{ env('SITE_NAME', 'EAMES') }}</title>
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="author" content="" />
  <meta name="og:site_name" content="" />
  <meta name="og:title" content="" />
  <meta name="og:description" content="" />
  <meta name="og:url" content="" />
@stop

@section('style')
  <style>
  </style>
@stop

@section('header')
  @include('partials.menubar')
@stop

@section('content')
  Dashboard
@endsection

@section('footer')
@stop

@section('scripts')
  <scripts>
  </scripts>
@endsection
