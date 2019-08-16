const mix = require('laravel-mix');
require('laravel-mix-imagemin');
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
    .extract(['vue', 'jquery', 'bootstrap', 'axios', 'lodash', 'popper.js']);

mix.sass('resources/sass/app.sass', 'public/css')
    .options({
        processCssUrls: false
    });

//mix.imagemin('public/images/*');

mix.browserSync({
    proxy: 'photocontest.l',
    notify: false
});

if (mix.inProduction()) {
    mix.version();
}
