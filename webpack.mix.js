const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/spa/src/main.js', 'public/static/dashboard/js/index.js')

mix.copy('resources/spa/public/index.html', 'resources/views/dashboard/index.blade.php');

