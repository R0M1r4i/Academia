let mix = require('laravel-mix');
require('laravel-mix-purgecss');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .purgeCss({
        paths: glob.sync([
            path.join(__dirname, 'public/assets/vendor/**/*.css'),
            path.join(__dirname, 'resources/views/**/*.blade.php'),
            // Agrega aquí otras rutas que quieras que PurgeCSS revise
        ]),

    });

