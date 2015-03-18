@extends('layouts.fullscreen')

@section('head')
  <title>Reset Password - {{ env('SITE_NAME', 'EAMES') }}</title>
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
      <p>Enter the email address associated with your account and create a new password.</p>
      {!! Form::open([ 'url' => 'password/reset' ]) !!}
        {!! Form::hidden('token', $token) !!}
        <div>
          {!! Form::email('email',null,['placeholder' => 'Email']) !!}
        </div>
        <div>
          {!! Form::password('password',['placeholder' => 'Password']) !!}
        </div>
        <div>
          {!! Form::password('password_confirmation',['placeholder' => 'Confirm Password']) !!}
        </div>
        <div>
          {!! Form::submit('Submit') !!}
        </div>
      {!! Form::close() !!}
    </div>
    <div id="login_meta">
      <div>
        {!! link_to('login','Return to Login') !!}
      </div>
    </div>
  </div>

@endsection

@section('footer')
@endsection

@section('scripts')
  <scripts>
  </scripts>
@endsection
