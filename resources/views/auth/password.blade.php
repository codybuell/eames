@extends('layouts.fullscreen')

@section('head')
  <title>Forgot Password - {{ env('SITE_NAME', 'EAMES') }}</title>
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
      <p>Enter the email address associated with your account.  An email will be sent with instructions for resetting your password.</p>
      {!! Form::open([ 'url' => 'login' ]) !!}
        <div>
          {!! Form::email('email',null,['placeholder' => 'Email']) !!}
        </div>
        <div>
          {!! Form::submit('Send Password Reset Link') !!}
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

@section('scripts')
  <scripts>
  </scripts>
@endsection
