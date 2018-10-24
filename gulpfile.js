var elixir = require('laravel-elixir');
require('laravel-elixir-vueify');
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

    //copy vendor files to public css folder
    mix.copy('node_modules/flatpickr/dist/flatpickr.min.css','public/css/flatpickr.min.css')

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
                'experts-styles.css',
                'media-queries.css',
                'basebar-styles.css',
                'tweeks.css'
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
              //'app.js'
          ],
            'public/js/public-scripts.js'
            );

                /*
                |---------------------------
                | Public Script Concat Mix
                |---------------------------
                 */

    mix.browserify('vue-caleventview.js', 'public/js/vue-caleventview.js');
    mix.browserify('vue-event-form.js', 'public/js/vue-event-form.js');
    mix.browserify('vue-announcement-form.js', 'public/js/vue-announcement-form.js');
    mix.browserify('vue-expert-form.js', 'public/js/vue-expert-form.js');
    mix.browserify('vue-expert-list.js', 'public/js/vue-expert-list.js');
    mix.browserify('vue-expert-request-list.js', 'public/js/vue-expert-request-list.js');
    mix.browserify('vue-expertmediarequest-form.js', 'public/js/vue-expertmediarequest-form.js');
    mix.browserify('vue-expertspeakerrequest-form.js', 'public/js/vue-expertspeakerrequest-form.js');
    mix.browserify('vue-expertcategory-form.js', 'public/js/vue-expertcategory-form.js');
    mix.browserify('vue-search-form.js', 'public/js/vue-search-form.js');
    mix.browserify('vue-search-form-offcanvas.js', 'public/js/vue-search-form-offcanvas.js');
    mix.browserify('vue-oauth-clients.js', 'public/js/vue-oauth-clients.js');
    mix.browserify('vue-oauth-authorized-clients.js', 'public/js/vue-oauth-authorized-clients.js');
    mix.browserify('vue-oauth-personal-access-tokens.js', 'public/js/vue-oauth-personal-access-tokens.js');
    mix.browserify('admin-emucustom.js', 'public/js/admin-emucustom.js');


    // mix.sass('app.scss');
});
/*
     |--------------------------------------------------------------------------
     | Admin Asset Management
     |--------------------------------------------------------------------------
     |
      */

      elixir(function(mix) {
          /*
          * Files for AdminLte Template
           */
         mix.copy('node_modules/admin-lte/dist/js/app.js', 'public/themes/admin-lte/js/app.js');
         mix.copy('node_modules/admin-lte/plugins', 'public/themes/admin-lte/plugins');
         // moving css and less to combine in admin-styles
         mix.copy('node_modules/admin-lte', 'resources/assets/themes/admin-lte');
         mix.copy('node_modules/bootstrap', 'resources/assets/vendor/bootstrap');
         mix.copy('node_modules/jquery', 'resources/assets/vendor/jquery');




        //  mix.copy('node_modules/bootstrap/fonts', 'public/build/fonts');
         mix.copy('node_modules/font-awesome', 'resources/assets/vendor/font-awesome');
        //
        mix.less('admin.less',
                    'resources/assets/css/admin-less.css',
                    {
                        includePaths: [
                            'node_modules/bootstrap/less',
                            'node_modules/admin-lte/less'
                        ],
                        outputStyles: 'expanded'
                    }
                );

                /*
    |---------------------------
    | Admin StyleSheet mix
    |---------------------------
     */
        mix.styles([
                    'admin-less.css',
                    'admin.css',
                ], 'public/css/admin-styles.css');

    /*
        |---------------------------
        | Vendor Script Concat Mix
        |---------------------------
         */

        mix.scripts([
            '../vendor/jquery/dist/jquery.min.js',
            '../vendor/bootstrap/dist/js/bootstrap.js',
            '../themes/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js',
            '../themes/admin-lte/plugins/fastclick/fastclick.min.js'
        ], 'public/js/vendor-scripts.js');


        mix.browserify('vue-announcement-queue.js', 'public/js/vue-announcement-queue.js');
        mix.browserify('vue-author-form.js', 'public/js/vue-author-form.js');
        mix.browserify('vue-email-form.js', 'public/js/vue-email-form.js');
        mix.browserify('vue-event-queue.js', 'public/js/vue-event-queue.js');
        mix.browserify('vue-event-lbcqueue.js', 'public/js/vue-event-lbcqueue.js');
        mix.browserify('vue-event-hscqueue.js', 'public/js/vue-event-hscqueue.js');
        mix.browserify('vue-mediahighlight-form.js', 'public/js/vue-mediahighlight-form.js');
        mix.browserify('vue-page-form.js', 'public/js/vue-page-form.js');
        mix.browserify('vue-story-queue.js', 'public/js/vue-story-queue.js');
        mix.browserify('vue-chart-app.js', 'public/js/vue-chart-app.js');
        mix.browserify('vue-story-form-wrapper.js', 'public/js/vue-story-form-wrapper.js');
        mix.browserify('vue-archive-queue.js', 'public/js/vue-archive-queue.js');
        mix.browserify('vue-storyideas-form.js', 'public/js/vue-storyideas-form.js');
        mix.browserify('vue-storyideas-list.js', 'public/js/vue-storyideas-list.js');
        mix.browserify('app.js', 'public/js/app.js');

});
