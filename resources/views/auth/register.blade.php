@extends('layouts.fullscreen-bare')

@section('head')
  <title>Register - {{ env('SITE_NAME', 'EAMES') }}</title>
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
      {!! Form::open([ 'url' => 'register' ]) !!}
        <div>
          {!! Form::text('first_name',null,['placeholder' => 'First Name']) !!}
        </div>
        <div>
          {!! Form::text('last_name',null,['placeholder' => 'Last Name']) !!}
        </div>
        <div>
          {!! Form::text('username',null,['placeholder' => 'Username']) !!}
        </div>
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
          {!! Form::submit('Register') !!}
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
