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

/*
|--------------------------------------------------------------------------
| Front End Styles
|--------------------------------------------------------------------------
|
| The styles that will appear on the public facing pages
|
*/
// Compile the front-end SASS styles
mix.sass('resources/assets/sass/public-app.scss', '../resources/assets/css/zfoundation.css');

// Combine all the front-end styles into one stylesheet
mix.combine([
    'resources/assets/css/zfoundation.css',
    'resources/assets/css/main-styles.css',
    'resources/assets/css/story-styles.css',
    'resources/assets/css/magazine-styles.css',
    'resources/assets/css/experts-styles.css',
    'resources/assets/css/media-queries.css',
    'resources/assets/css/basebar-styles.css',
    'resources/assets/css/tweeks.css'
], 'public/css/public-styles.css')

/*
|--------------------------------------------------------------------------
| Developmental
|--------------------------------------------------------------------------
*/
// Refresh page in local environment
mix.browserSync('emutoday.test');
