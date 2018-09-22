let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

/*
mix.styles([
    'toastr/build/toastr.min.css',
    'highlight.js/styles/atom-one-dark.css'
], 'public/css/app.css');*/

mix.styles([
    'node_modules/toastr/build/toastr.css/toastr.min.css'
], 'public/css/all.css');