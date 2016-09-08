var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {


    //Copy the fonts to build folder:
    mix.copy('node_modules/font-awesome/fonts','public/build/fonts')
    mix.sass('public-app.scss',
                        'resources/assets/css/zfoundation.css',
                        {
                            includePaths: [
                                // 'node_modules/motion-ui/src',
                                'node_modules/foundation-sites/scss/'
                            ],
                            outputStyles: 'expanded'
                        }
                    );

    /*
    |---------------------------
    | Public StyleSheet mix
    |---------------------------
     */
    mix.styles([
                'zfoundation.css',
                'main-styles.css',
                'story-styles.css',
                'magazine-styles.css',
                'media-queries.css',
                'tweeks.css',
                ], 'public/css/public-styles.css');

    mix.scripts([
                'vendor-public/jquery.min.js',
                'vendor-public/what-input.min.js',
                // 'foundation/motion-ui.js',
                'foundation/foundation.core.js',
                'foundation/foundation.abide.js',
              'foundation/foundation.accordion.js',
              'foundation/foundation.accordionMenu.js',
              'foundation/foundation.drilldown.js',
              'foundation/foundation.dropdown.js',
              'foundation/foundation.dropdownMenu.js',
              'foundation/foundation.equalizer.js',
              'foundation/foundation.interchange.js',
              'foundation/foundation.magellan.js',
              'foundation/foundation.offcanvas.js',
              'foundation/foundation.orbit.js',
              'foundation/foundation.responsiveMenu.js',
              'foundation/foundation.responsiveToggle.js',
              'foundation/foundation.reveal.js',
              'foundation/foundation.slider.js',
              'foundation/foundation.sticky.js',
              'foundation/foundation.tabs.js',
              'foundation/foundation.toggler.js',
              'foundation/foundation.tooltip.js',
              'foundation/foundation.util.box.js',
              'foundation/foundation.util.keyboard.js',
              'foundation/foundation.util.mediaQuery.js',
              'foundation/foundation.util.motion.js',
              'foundation/foundation.util.nest.js',
              'foundation/foundation.util.timerAndImageLoader.js',
              'foundation/foundation.util.touch.js',
              'foundation/foundation.util.triggers.js',
              'app.js'
          ],
            'public/js/public-scripts.js'
            );

                /*
                |---------------------------
                | Public Script Concat Mix
                |---------------------------
                 */


    // mix.sass('app.scss');
});

/*
 |--------------------------------------------------------------------------
 | Version Asset Management
 |--------------------------------------------------------------------------
 |
  */
elixir(function(mix) {
    mix.version(['css/public-styles.css','js/public-scripts.js']);

    // mix.version(['css/public-styles.css','js/public-scripts.js','css/admin-styles.css', 'js/vendor-scripts.js','js/admin-scripts.js']);
});
