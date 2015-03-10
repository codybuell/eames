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
    mix.sass('screen.scss','public/assets/styles');

    mix.scripts([
      '../assets/bower/jquery/dist/jquery.js',
      '../assets/bower/bootstrap/dist/js/bootstrap.js'
    ],'public/assets/scripts/engines.js');
});
