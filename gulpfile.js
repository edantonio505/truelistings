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

//Root folder Base-------- 
var base = '../../../bower/';

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
        'main.js'
    ])
    .sass('app.scss', 'resources/assets/css')
    .scripts([
        // Vendor javascript dependencies--------------------
        base+'jquery/dist/jquery.min.js',
        base+'jquery-ui/jquery-ui.min.js',
        base+'angular/angular.min.js',
        base+'angular-ui-router/release/angular-ui-router.min.js',
        base+'ng-page-title/dist/ng-page-title.min.js',
        base+'semantic/dist/semantic.min.js',
        base+'angular-svg-round-progressbar/build/roundProgress.min.js',
        base+'imagesloaded/imagesloaded.pkgd.min.js',
        base+'masonry/dist/masonry.pkgd.min.js',
        base+'angular-masonry/angular-masonry.js',
        // ----------------------------


        // Main App js----------------
        'app.js',
        // ---------------------------


        // Controllers-----------------
        'controllers/mainController.js',
        'controllers/homeController.js',
        'controllers/searchController.js',
        // ----------------------------

        // services--------------------
        'services/services.js',
        // ----------------------------

        // directives------------------
        'directives/dropdown.js',
        'directives/progress.js',
        'directives/wishes-search.js',
        'directives/wishes-search-list.js',
        'directives/search-result-box.js',
        'directives/wishes.js'
        // ----------------------------

    ], 'public/js/app.js')
    .styles([
        // Vendor styles----------------------
        base+'semantic/dist/semantic.min.css',
        base+'font-awesome/css/font-awesome.min.css',
        base+'bootstrap/dist/css/bootstrap.min.css',
        base+'jquery-ui/themes/base/jquery-ui.min.css',
        // -----------------------------------




        // main app css-----------------------
        'app.css',
        // ----------------------------------


    ], 'public/css/app.css')
    .styles([
        'foundation-flex.css',
        'foundation.css',
        'foundation-icons.css',
        'jquery-ui.css',
        'transition.css',
        'dropdown.css',
        'main.css'
    ])
    .version(['css/all.css', 'js/all.js', 'js/app.js', 'css/app.css']);
});