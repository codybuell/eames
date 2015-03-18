@if (Session::has('alert'))
  <div id="alert_bar">
    <button class="text_button dismiss fa fa-times-circle"></button>
    {{ Session::get('alert') }}
  </div>
@endif
@if (Session::has('errors'))
  <div id="error_bar">
    <button class="text_button dismiss fa fa-times-circle"></button>
    @foreach ($errors->all() as $error)
      {{ $error }}
    @endforeach
  </div>
@endif
