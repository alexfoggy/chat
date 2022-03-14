"use strict";

var mix = require('laravel-mix');
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


mix.react('resources/js/app.js', 'public/js');
mix.react('resources/js/admin.js', 'public/js');
//mix.sass('resources/sass/app.scss', 'public/css');
//
//mix.sass('resources/sass/public.scss', 'public/css/public.css');
//
//mix.sass('resources/sass/components/sidebar.scss', 'public/css/components')
// .sass('resources/sass/components/block.scss', 'public/css/components')
//.sass('resources/sass/components/form.scss', 'public/css/components');
//
// mix.sass('resources/views/ui/components/form.scss', 'ui/components/');
// mix.sass('resources/views/ui/components/task.scss', 'ui/components/');
// mix.sass('resources/views/ui/components/tabs.scss', 'ui/components/');
// mix.browserSync('unicrowd.com');
