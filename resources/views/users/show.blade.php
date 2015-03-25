@extends('layouts.default')

@section('head')
  <title>{{ $user->profile->first_name }} {{ $user->profile->last_name }} - {{ env('SITE_NAME', 'EAMES') }}</title>
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
  <div class="row">
    <div class="col-md-7">
      <img id="profile_image" class="pull-left" src="{{ $user->profile->photo }}" />
      <label>First Name:</label> {{ $user->profile->first_name }}<br />
      <label>Last Name:</label>{{ $user->profile->last_name }}<br />
      <label>Title:</label> {{ $user->profile->title }}<br />
      <label>Email:</label> {{ $user->email }}<br />
      <label>Office Phone:</label> {{ $user->profile->phone_work_office }}<br />
      <label>Work Cell:</label> {{ $user->profile->phone_work_mobile }}<br />
      <label>Personal Phone:</label> {{ $user->profile->phone_personal_home }}<br />
      <label>Personal Cell:</label> {{ $user->profile->phone_personal_mobile }}<br />
      <label>Office Location:</label> {{ $user->profile->office_location }}<br />
      <label>Manager:</label> {{ $user->profile->manager_id }}<br />
    </div>
    <div class="col-md-5">
      <label>ID:</label> {{ $user->id }}<br />
      <label>Username:</label> {{ $user->username }}<br />
      <label>Role:</label> {{ $user->role->name }}<br />
      <label>Active:</label> {{ $user->active }}<br />
      <label>Last Login:</label> {{ $user->last_login }}<br />
      <label>Login Count:</label> {{ $user->login_count }}<br />
      <label>Created At:</label> {{ $user->created_at }}<br />
      <label>Updated At:</label> {{ $user->updated_at }}<br />
      <label>Created By:</label> {{ $user->created_by }}<br />
      <label>Updated By:</label> {{ $user->updated_by }}<br />
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 mark_content">
      <hr />
      {!! $notes !!}
    </div>
  </div>
@endsection

@section('footer')
@stop

@section('scripts')
  <scripts>
  </scripts>
@endsection
