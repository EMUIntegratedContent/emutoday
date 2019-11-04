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
| Front End Styles
|--------------------------------------------------------------------------
|
| The styles that will appear on the public facing pages
|
*/
mix.combine([
    'resources/assets/js/vendor-public/jquery.min.js',
    'node_modules/foundation-sites/js/foundation.core.js',
    'node_modules/foundation-sites/js/foundation.abide.js',
    'node_modules/foundation-sites/js/foundation.accordion.js',
    'node_modules/foundation-sites/js/foundation.accordionMenu.js',
    'node_modules/foundation-sites/js/foundation.drilldown.js',
    'node_modules/foundation-sites/js/foundation.dropdown.js',
    'node_modules/foundation-sites/js/foundation.dropdownMenu.js',
    'node_modules/foundation-sites/js/foundation.equalizer.js',
    // 'node_modules/foundation-sites/js/foundation.interchange.js',
    // 'node_modules/foundation-sites/js/foundation.magellan.js',
    'node_modules/foundation-sites/js/foundation.offcanvas.js',
    // 'node_modules/foundation-sites/js/foundation.orbit.js',
    'node_modules/foundation-sites/js/foundation.responsiveMenu.js',
    'node_modules/foundation-sites/js/foundation.responsiveToggle.js',
    'node_modules/foundation-sites/js/foundation.reveal.js',
    'node_modules/foundation-sites/js/foundation.slider.js',
    'node_modules/foundation-sites/js/foundation.sticky.js',
    // 'node_modules/foundation-sites/js/foundation.tabs.js',
    // 'node_modules/foundation-sites/js/foundation.toggler.js',
    'node_modules/foundation-sites/js/foundation.tooltip.js',
    'node_modules/foundation-sites/js/foundation.util.box.js',
    'node_modules/foundation-sites/js/foundation.util.keyboard.js',
    'node_modules/foundation-sites/js/foundation.util.mediaQuery.js',
    'node_modules/foundation-sites/js/foundation.util.motion.js',
    'node_modules/foundation-sites/js/foundation.util.nest.js',
    'node_modules/foundation-sites/js/foundation.util.timerAndImageLoader.js',
    'node_modules/foundation-sites/js/foundation.util.touch.js',
    'node_modules/foundation-sites/js/foundation.util.triggers.js',
], 'public/js/public-scripts.js');

/*
|--------------------------------------------------------------------------
| Developmental
|--------------------------------------------------------------------------
*/
// Refresh page in local environment
mix.browserSync('emutoday.test');
