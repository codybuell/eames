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
        <div class="col-md-4">
          {!! Form::text('title',null,['placeholder' => 'Title', 'class' => 'full']) !!}
        </div>
        <div class="col-md-2">
          {!! Form::text('datetime',null,['placeholder' => 'Date', 'id' => 'datetimepicker', 'class' => 'full']) !!}
        </div>
        <div class="col-md-2">
          {!! Form::select('assoc',$assoc,null,['id' => 'log_selector', 'class' => 'full chosen-select']) !!}
          <!--{!! Form::select('title[]',$related,null,['id' => 'log_selector', 'class' => 'full chosen-select limited-select', 'multiple' => 'multiple']) !!}-->
        </div>
        <div class="col-md-2">
          {!! Form::text('placeholder',null,['placeholder' => '', 'id' => 'log_placeholder', 'class' => 'full dependent', 'disabled' => 'disabled']) !!}
          <div id="log_hardware" class="dependent hidden">{!! Form::select('hardware_id',$related['hardwares'],null,['class' => 'full chosen-select']) !!}</div>
          <div id="log_software" class="dependent hidden">{!! Form::select('software_id',$related['softwares'],null,['class' => 'full chosen-select']) !!}</div>
          <div id="log_license" class="dependent hidden">{!! Form::select('license_id',$related['licenses'],null,['class' => 'full chosen-select']) !!}</div>
          <div id="log_installation" class="dependent hidden">{!! Form::select('installation_id',$related['installations'],null,['class' => 'full chosen-select']) !!}</div>
          <div id="log_project" class="dependent hidden">{!! Form::select('project_id',$related['projects'],null,['class' => 'full chosen-select']) !!}</div>
          <div id="log_task" class="dependent hidden">{!! Form::select('task_id',$related['tasks'],null,['class' => 'full chosen-select']) !!}</div>
          <div id="log_issue" class="dependent hidden">{!! Form::select('issue_id',$related['issues'],null,['class' => 'full chosen-select']) !!}</div>
          <div id="log_event" class="dependent hidden">{!! Form::select('event_id',$related['events'],null,['class' => 'full chosen-select']) !!}</div>
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
