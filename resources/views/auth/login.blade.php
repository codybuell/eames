@extends('layouts.fullscreen')

@section('head')
  <title>Login - {{ env('SITE_NAME', 'EAMES') }}</title>
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

@section('content')

  <div id="login_wrapper">
    <div id="login_form">
      {!! Form::open([ 'url' => 'login' ]) !!}
        <div>
          {!! Form::text('login',null,['placeholder' => 'Email or Username']) !!}
        </div>
        <div>
          {!! Form::password('password',['placeholder' => 'Password']) !!}
        </div>
        <div>
          {!! Form::submit('Login') !!}
        </div>
      {!! Form::close() !!}
    </div>
    <div id="login_meta">
      <div>
        {!! link_to('password/email','Forgot your password?') !!}
      </div>
      <div>
        {!! link_to('register','Register') !!}
      </div>
    </div>
  </div>

@endsection

@section('scripts')
  <scripts>
  </scripts>
@endsection
