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
  @include('partials.toolbar')
@stop

@section('content')
  <table class="table">
    <thead>
      <tr>
        <th>
          ID
        </th>
        <th>
          Name
        </th>
        <th>
          Username
        </th>
        <th>
          Role
        </th>
        <th>
          Last Modified
        </th>
        <th>
          Last Login
        </th>
        <th class="nr">
          Login Count
        </th>
        <th>
          Actions
        </th>
      </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
      @if ($user->active)
        <tr>
      @else
        <tr class="inactive">
      @endif
        <td class="cell-condensed">
          {{ $user->id }}
        </td>
        <td>
          {!! link_to("users/{$user->username}", $user->profile->first_name.' '.$user->profile->last_name) !!}
        </td>
        <td>
          {!! link_to("users/{$user->username}", $user->username) !!}
        </td>
        <td>
          $user->role->name
        </td>
        <td class="cell-condensed">
          {{ $user->profile->updated_at }}
        </td>
        <td class="cell-condensed">
          {{ $user->last_login }}
        </td>
        <td class="cell-condensed tac">
          {{ $user->login_count }}
        </td>
        <td class="cell-condensed">
          <a href="mailto:{{ $user->email }}"><button class="icon_email text_button">Email</button></a>
          <a href="{{ url("users/{$user->username}") }}"><button class="icon_profile text_button">View</button></a>
          <a href="{{ url("users/{$user->username}/edit") }}"><button class="icon_edit text_button">Edit</button></a>
          @if ($user->username != 'root')
            {!! Form::open(array('route' => array('users.destroy', $user->id),'method' => 'DELETE','class' => 'inline')) !!}
              {!! Form::button('Delete',array('class' => 'icon_trash_thin text_button confirm','type' => 'submit')) !!}
            {!! Form::close() !!}
            @if ($user->active)
              {!! Form::open(array('route' => 'users.activate','class' => 'inline')) !!}
                {!! Form::hidden('id',$user->id) !!}
                {!! Form::button('Deactivate',array('class' => 'icon_power text_button confirm','type' => 'submit')) !!}
              {!! Form::close() !!}
            @else
              {!! Form::open(array('route' => 'users.activate','class' => 'inline')) !!}
                {!! Form::hidden('id',$user->id) !!}
                {!! Form::button('Activate',array('class' => 'icon_power text_button confirm','type' => 'submit')) !!}
              {!! Form::close() !!}
            @endif
          @endif
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection

@section('footer')
@stop

@section('scripts')
  <scripts>
  </scripts>
@endsection
