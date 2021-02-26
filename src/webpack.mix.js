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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');
mix.copy('resources/back/','public/');
// mix.styles([
//     'resources/back/css/bootstrap.min.css',
//     'resources/back/css/plugins/dataTables/datatables.min.css',
//     'resources/back/css/animate.css',
//     'resources/back/css/style.css'
// ], 'public/css/all.css');

// mix.babel([
//     'resources/back/js/jquery-3.1.1.min.js',
//     'resources/back/js/popper.min.js',
//     'resources/back/js/bootstrap.js',
//     'resources/back/js/plugins/metisMenu/jquery.metisMenu.js',
//     'resources/back/js/plugins/slimscroll/jquery.slimscroll.min.js',
//     'resources/back/js/plugins/dataTables/datatables.min.js',
//     'resources/back/js/inspinia.js',
//     'resources/back/js/plugins/pace/pace.min.js',
//     'resources/back/js/MyApps.js',
// ],'public/js/all.js');