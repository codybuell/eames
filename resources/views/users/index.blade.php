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
@endsection

@section('style')
  <style>
  </style>
@endsection

@section('header')
  @include('partials.menubar')
@endsection

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
        <th class="text-nowrap">
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
        <td class="condensed">
          {{ $user->id }}
        </td>
        <td>
          {!! link_to("users/{$user->id}", $user->profile->first_name.' '.$user->profile->last_name) !!}
        </td>
        <td>
          {!! link_to("users/{$user->id}", $user->username) !!}
        </td>
        <td>
          {{ $user->role->name }}
        </td>
        <td class="condensed">
          {{ $user->profile->updated_at }}
        </td>
        <td class="condensed">
          {{ $user->last_login }}
        </td>
        <td class="condensed text-center">
          {{ $user->login_count }}
        </td>
        <td class="condensed">
          <a href="mailto:{{ $user->email }}">@include('partials.buttons.email')</a>
          <a href="{{ url("users/{$user->id}") }}">@include('partials.buttons.view')</a>
          <a href="{{ url("users/{$user->id}/edit") }}">@include('partials.buttons.edit')</a>
          @if ($user->username != 'root')
            {!! Form::open(['route' => ['users.destroy', $user->id],'method' => 'DELETE','class' => 'inline']) !!}
              @include('partials.buttons.delete')
            {!! Form::close() !!}
            @if ($user->active)
              {!! Form::open(['route' => 'users.activate','class' => 'inline']) !!}
                {!! Form::hidden('id',$user->id) !!}
                @include('partials.buttons.activate')
              {!! Form::close() !!}
            @else
              {!! Form::open(['route' => 'users.activate','class' => 'inline']) !!}
                {!! Form::hidden('id',$user->id) !!}
                @include('partials.buttons.activate')
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
@endsection

@section('scripts')
  <scripts>
  </scripts>
@endsection
