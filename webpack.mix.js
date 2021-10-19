const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

//  mix.autoload({
//     'jquery': ['$', 'window.jQuery', "jQuery", "window.$", "jquery", "window.jquery"],
//     'popper.js/dist/umd/popper.js': ['Popper', 'window.Popper']
// });

mix.js([
        'resources/js/app.js',
        'node_modules/popper.js/dist/umd/popper.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',
    ], 'public/js')
    .vue()
    // .sass([
    //     'resources/sass/app.scss',
    //     'node_modules/bootstrap/scss/bootstrap.scss'
    // ], 'public/css')
    .sass('resources/sass/app.scss', 'public/css')
    .css('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/css');
