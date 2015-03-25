<!DOCTYPE html>
<html>
  <head>
    @yield('head')
    {!! HTML::style('assets/styles/screen.css', array('media' => 'screen')) !!}
    {!! HTML::style('assets/styles/print.css', array('media' => 'print')) !!}
    <!--[if IE]>
      {!! HTML::style('assets/styles/styleie.css', array('media' => 'print')) !!}
    <![endif]-->
    <link href="{{ asset('assets/graphics/favicon.ico') }}" rel="shortcut icon" type="image/x-icon" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('assets/graphics/apple-touch-icon-114x114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('assets/graphics/apple-touch-icon-72x72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/graphics/apple-touch-icon-precomposed.png') }}">
    <meta name="og:image" content="{{ asset('assets/graphics/apple-touch-icon-114x114-precomposed.png') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <meta http-equiv="imagetoolbar" content="false" />
    <meta name="viewport" content="width=device-width">
    <meta charset="utf-8">
    @yield('style')
  </head>
  <body>
    <div id="wrapper">
      <header>
        @include('partials.alertbar')
        @yield('header')
      </header>
      <div id="content" class="container">
        @yield('content')
      </div>
      <footer>
        @yield('footer')
      </footer>
    </div>
    {!! HTML::script('assets/scripts/engines.js') !!}
    {!! HTML::script('assets/scripts/plugins.js') !!}
    {!! HTML::script('assets/scripts/scripts.js') !!}
    @yield('scripts')
    @if(App::environment('production'))
      @include('partials.analytics')
    @endif
  </body>
</html>
