var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    // styles
    mix.sass([
      'screen.scss',
      'print.scss',
      'styleie.scss',
    ],'public/assets/styles');

    // fonts
    mix.copy('resources/assets/bower/font-awesome/fonts', 'public/assets/fonts');

    // graphics
    mix.copy('resources/assets/bower/bootstrap-chosen/chosen-sprite@2x.png', 'public/assets/graphics/chosen-sprite@2x.png');
    mix.copy('resources/assets/bower/bootstrap-chosen/chosen-sprite.png', 'public/assets/graphics/chosen-sprite.png');

    // engines
    mix.scripts([
      '../assets/bower/jquery/dist/jquery.js',
      '../assets/bower/d3/d3.js',
      '../assets/bower/bootstrap-sass-official/assets/javascripts/bootstrap.js',
      '../assets/bower/moment/moment.js',
    ],'public/assets/scripts/engines.js');

    // plugins
    mix.scripts([
      '../assets/bower/colorbrewer/colorbrewer.js',
      '../assets/bower/chosen/chosen.jquery.min.js',
      '../assets/bower/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
    ],'public/assets/scripts/plugins.js');

    // scripts
    mix.scripts([
      'library.js',
      'documentready.js',
      'windowready.js',
    ],'public/assets/scripts/scripts.js');

});
