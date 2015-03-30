@extends('layouts.default')

@section('head')
  <title>Create User - {{ env('SITE_NAME', 'EAMES') }}</title>
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
  {!! Form::open(['route' => 'users.store', 'files' => true]) !!}
    <div class="row">
      <div class="col-md-4">
        {!! Form::label('username', 'Username') !!}
        {!! Form::text('username',null,['placeholder' => 'Username', 'class' => 'full', 'tabindex' => '1']) !!}
        {!! Form::label('profile[first_name]', 'First Name') !!}
        {!! Form::text('profile[first_name]',null,['placeholder' => 'First Name', 'class' => 'full', 'tabindex' => '1']) !!}
        {!! Form::label('profile[last_name]', 'Last Name') !!}
        {!! Form::text('profile[last_name]',null,['placeholder' => 'Last Name', 'class' => 'full', 'tabindex' => '2']) !!}
        {!! Form::label('profile[title]', 'Title') !!}
        {!! Form::text('profile[title]',null,['placeholder' => 'Title', 'class' => 'full', 'tabindex' => '3']) !!}
        {!! Form::label('profile[office_location]', 'Office Location') !!}
        {!! Form::text('profile[office_location]',null,['placeholder' => 'Office Location', 'class' => 'full', 'tabindex' => '4']) !!}
        {!! Form::label('profile[manager_id]', 'Manager') !!}
        {!! Form::select('profile[manager_id]', $managers, null, ['class' => 'full', 'tabindex' => '5']) !!}
        {!! Form::label('password', 'Password') !!}
        {!! Form::password('password',['placeholder' => 'Password', 'class' => 'full', 'tabindex' => '13']) !!}
      </div>
      <div class="col-md-4">
        {!! Form::label('role_id', 'Role') !!}
        {!! Form::select('role_id', $roles, null, ['class' => 'full', 'tabindex' => '6']) !!}
        {!! Form::label('email', 'Email Address') !!}
        {!! Form::email('email',null,['placeholder' => 'Email', 'class' => 'full', 'tabindex' => '7']) !!}
        {!! Form::label('profile[phone_work_office]', 'Office Phone') !!}
        {!! Form::text('profile[phone_work_office]',null,['placeholder' => 'Work Phone (Office)', 'class' => 'full', 'tabindex' => '8']) !!}
        {!! Form::label('profile[phone_work_mobile]', 'Work Mobile Phone') !!}
        {!! Form::text('profile[phone_work_mobile]',null,['placeholder' => 'Work Phone (Mobile)', 'class' => 'full', 'tabindex' => '9']) !!}
        {!! Form::label('profile[phone_personal_home]', 'Personal Home Phone') !!}
        {!! Form::text('profile[phone_personal_home]',null,['placeholder' => 'Personal Phone (Home)', 'class' => 'full', 'tabindex' => '10']) !!}
        {!! Form::label('profile[phone_personal_mobile]', 'Personal Mobile Phone') !!}
        {!! Form::text('profile[phone_personal_mobile]',null,['placeholder' => 'Personal Phone (Mobile)', 'class' => 'full', 'tabindex' => '11']) !!}
        {!! Form::label('password_confirmation', 'Password Confirmation') !!}
        {!! Form::password('password_confirmation',['placeholder' => 'Confirm Password', 'class' => 'full', 'tabindex' => '14']) !!}
      </div>
      <div class="col-md-4">
        {!! Form::label('profile[photo]', 'Profile Image') !!}
        <div class="input-group">
          <span class="input-group-btn">
            <span class="btn btn-default btn-file">
              Browse&hellip; <input name="profile[photo]" type="file" accept="image/x-png, image/gif, image/jpeg">
            </span>
          </span>
          <input type="text" class="full" readonly>
        </div>
        {!! Form::label('profile[notes]', 'Notes') !!}
        {!! Form::textarea('profile[notes]',null,['placeholder' => 'Notes', 'id' => 'create_user_notes', 'class' => 'full', 'tabindex' => '12']) !!}
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        {!! Form::submit('Create',['class' => 'full']) !!}
      </div>
    </div>
    <div class="cb"></div>
  {!! Form::close() !!}
@endsection

@section('footer')
@stop

@section('scripts')
  <script>
    $(document).on('change', '.btn-file :file', function() {
      var input = $(this),
          numFiles = input.get(0).files ? input.get(0).files.length : 1,
          label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
      input.trigger('fileselect', [numFiles, label]);
    });

    $(document).ready( function() {
        $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;
            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }
        });
    });
  </script>
@endsection
