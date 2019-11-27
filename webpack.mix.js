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
// mix
//     .js('resources/js/admin/design.js', 'public/js/admin');

mix.js('resources/js/pages/admin/settings.js', 'public/js/admin').sass('resources/sass/animations.scss', 'public/css');
mix.js('resources/js/pages/admin/design.js', 'public/js/admin');
mix.js('resources/js/pages/admin/servers.js', 'public/js/admin');
mix.js('resources/js/pages/admin/web.js', 'public/js/admin');
mix.js('resources/js/pages/index.js', 'public/js');
