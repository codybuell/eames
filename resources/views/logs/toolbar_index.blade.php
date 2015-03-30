<div class="toolbar text-right">
  <a href="{{ route('logs.create') }}">@include('partials.buttons.create')</button></a>
  {!! Form::text('search',null,array('placeholder' => 'Search', 'class' => 'search fr', 'data-action' => '/logs/search/')) !!}
</div>
