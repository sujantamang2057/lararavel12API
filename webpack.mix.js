let mix = require('laravel-mix');


/* Allow multiple Laravel Mix applications*/
require('laravel-mix-merge-manifest');
mix.mergeManifest();
/*----------------------------------------*/

//backend
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');