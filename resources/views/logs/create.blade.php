@extends('layouts.fullscreen')

@section('head')
  <title>Create Activity Log - {{ env('SITE_NAME', 'EAMES') }}</title>
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
  <div class="full_page_basic_form">
    {!! Form::open([ 'route' => 'logs.store' ]) !!}
      <div class="row">
        <div class="col-md-6">
          {!! Form::text('title',null,['placeholder' => 'Title', 'class' => 'full']) !!}
        </div>
        <div class="col-md-2">
          {!! Form::select('assoc',$assoc,null,['id' => 'log_selector', 'class' => 'full chosen-select']) !!}
        </div>
        <div class="col-md-2">
          {!! Form::text('system',null,['placeholder' => '', 'id' => 'log_placeholder', 'class' => 'full dependent', 'disabled' => 'disabled']) !!}
          {!! Form::text('system',null,['placeholder' => 'hardware', 'id' => 'log_hardware', 'class' => 'full dependent hidden']) !!}
          {!! Form::text('system',null,['placeholder' => 'software', 'id' => 'log_software', 'class' => 'full dependent hidden']) !!}
          {!! Form::text('system',null,['placeholder' => 'license', 'id' => 'log_license', 'class' => 'full dependent hidden']) !!}
          {!! Form::text('system',null,['placeholder' => 'installation', 'id' => 'log_installation', 'class' => 'full dependent hidden']) !!}
          {!! Form::text('system',null,['placeholder' => 'mainteneance', 'id' => 'log_maintenance', 'class' => 'full dependent hidden']) !!}
          {!! Form::text('system',null,['placeholder' => 'project', 'id' => 'log_project', 'class' => 'full dependent hidden']) !!}
          {!! Form::text('system',null,['placeholder' => 'task', 'id' => 'log_task', 'class' => 'full dependent hidden']) !!}
          {!! Form::text('system',null,['placeholder' => 'issue', 'id' => 'log_issue', 'class' => 'full dependent hidden']) !!}
          {!! Form::text('system',null,['placeholder' => 'event', 'id' => 'log_event', 'class' => 'full dependent hidden']) !!}
        </div>
        <div class="col-md-2">
          {!! Form::select('type',$types,null,['class' => 'full chosen-select']) !!}
        </div>
      </div>
      {!! Form::textarea('notes',null,['placeholder' => 'Activity', 'class' => 'mono']) !!}
      {!! Form::submit('Save') !!}
    {!! Form::close() !!}
  </div>
@endsection

@section('footer')
@endsection

@section('scripts')
  <script>
  </script>
@endsection
