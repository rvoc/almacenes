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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/login.js', 'public/js')
    .sass('resources/sass/login.scss', 'public/css')
    .sass('resources/sass/wkhtml.scss', 'public/css')
    .sass('resources/sass/materialicons.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/table.scss', 'public/css');

