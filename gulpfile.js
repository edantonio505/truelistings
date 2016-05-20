var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.scripts([
        'jquery.js',
        'jquery-ui.js',
        'jquery.mixitup.js',
        'jquery.geocomplete.js',
        'foundation.js',
        'what-input.min.js',
        'transition.js',
        'dropdown.js',
        'app.js'
    ])
    .styles([
        'foundation-flex.css',
        'foundation.css',
        'foundation-icons.css',
        'jquery-ui.css',
        'transition.css',
        'dropdown.css',
        'main.css'
    ])
    .version(['css/all.css', 'js/all.js']);
});
