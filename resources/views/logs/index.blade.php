@extends('layouts.default')

@section('head')
  <title>Activity Log - {{ env('SITE_NAME', 'EAMES') }}</title>
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
  @include('logs.toolbar_index')
@endsection

@section('content')
  @include('logs.list_table')
@endsection

@section('footer')
@endsection

@section('scripts')
  <script>
  </script>
@endsection
