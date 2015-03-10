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
      'styleie.scss'
    ],'public/assets/styles');

    // engines
    mix.scripts([
      '../assets/bower/jquery/dist/jquery.js',
      '../assets/bower/bootstrap/dist/js/bootstrap.js',
      '../assets/bower/d3/d3.js'
    ],'public/assets/scripts/engines.js');

    // plugins
    mix.scripts([
      '../assets/bower/colorbrewer/colorbrewer.js'
    ],'public/assets/scripts/plugins.js');

    // scripts
    mix.scripts([
      'library.js',
      'documentready.js',
      'windowready.js'
    ],'public/assets/scripts/scripts.js');

});
