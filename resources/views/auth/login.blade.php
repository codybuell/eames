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
@stop

@section('style')
  <style>
  </style>
@stop

@section('header')
  @include('partials.toolbar')
@stop

@section('content')

  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div id="login_wrapper">
    <div id="login_form">
      {!! Form::open([ 'url' => 'login' ]) !!}
        <div>
          {!! Form::text('email',null,['placeholder' => 'Email']) !!}
        </div>
        <div>
          {!! Form::password('password',['placeholder' => 'Password']) !!}
        </div>
        <div>
          {!! Form::submit('Login') !!}
        </div>
      {!! Form::close() !!}
    </div> <!-- login form -->
    <div id="login_meta">
      <div>
        {!! link_to('password/email','Forgot your password?') !!}
      </div>
      <div>
        {!! link_to('register','Register') !!}
      </div>
    </div> <!-- login meta -->
  </div> <!-- login wrapper -->

@endsection

@section('footer')
@stop

@section('scripts')
  <scripts>
  </scripts>
@endsection
