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


elixir(function (mix) {
    mix.less('app.less')
        .scripts([
            "vendor/jquery-1.11.3.min.js",
            "vendor/bootstrap.min.js",
            "app.js"
        ], 'public/js/app.min.js', 'resources/assets/js');

    mix.version(["js/app.min.js", "css/app.css"]);

});
