const mix = require('laravel-mix')
require('laravel-mix-listen')

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
// mix.sass('resources/assets/sass/public-app.scss', '../resources/assets/css/zfoundation.css');

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
| Front End Scripts
|--------------------------------------------------------------------------
|
| The scripts that will run on the public facing pages
|
*/
// mix.combine([
//     'resources/assets/js/vendor-public/jquery.min.js',
//     'node_modules/foundation-sites/js/foundation.core.js',
//     'node_modules/foundation-sites/js/foundation.abide.js',
//     'node_modules/foundation-sites/js/foundation.accordion.js',
//     'node_modules/foundation-sites/js/foundation.accordionMenu.js',
//     'node_modules/foundation-sites/js/foundation.drilldown.js',
//     'node_modules/foundation-sites/js/foundation.dropdown.js',
//     'node_modules/foundation-sites/js/foundation.dropdownMenu.js',
//     'node_modules/foundation-sites/js/foundation.equalizer.js',
//     // 'node_modules/foundation-sites/js/foundation.interchange.js',
//     // 'node_modules/foundation-sites/js/foundation.magellan.js',
//     'node_modules/foundation-sites/js/foundation.offcanvas.js',
//     // 'node_modules/foundation-sites/js/foundation.orbit.js',
//     'node_modules/foundation-sites/js/foundation.responsiveMenu.js',
//     'node_modules/foundation-sites/js/foundation.responsiveToggle.js',
//     'node_modules/foundation-sites/js/foundation.reveal.js',
//     'node_modules/foundation-sites/js/foundation.slider.js',
//     'node_modules/foundation-sites/js/foundation.sticky.js',
//     // 'node_modules/foundation-sites/js/foundation.tabs.js',
//     // 'node_modules/foundation-sites/js/foundation.toggler.js',
//     'node_modules/foundation-sites/js/foundation.tooltip.js',
//     'node_modules/foundation-sites/js/foundation.util.box.js',
//     'node_modules/foundation-sites/js/foundation.util.keyboard.js',
//     'node_modules/foundation-sites/js/foundation.util.mediaQuery.js',
//     'node_modules/foundation-sites/js/foundation.util.motion.js',
//     'node_modules/foundation-sites/js/foundation.util.nest.js',
//     'node_modules/foundation-sites/js/foundation.util.timerAndImageLoader.js',
//     'node_modules/foundation-sites/js/foundation.util.touch.js',
//     'node_modules/foundation-sites/js/foundation.util.triggers.js',
// ], 'public/js/public-scripts.js');

// Compile vue files
// mix.js('resources/assets/js/vue-caleventview.js', 'public/js/vue-caleventview.js');
// mix.js('resources/assets/js/vue-email-form.js', 'public/js/vue-email-form.js');
// mix.js('resources/assets/js/vue-mediahighlight-form.js', 'public/js/vue-mediahighlight-form.js');
// mix.js('resources/assets/js/vue-page-form.js', 'public/js/vue-page-form.js');
// mix.js('resources/assets/js/vue-author-form.js', 'public/js/vue-author-form.js');

// Stuff I've worked on already (comment out all but the one you're working on to save compile time)
mix.js('resources/assets/js/vue-event-form.js', 'public/js/vue-event-form.js').vue();
mix.js('resources/assets/js/vue-event-queue.js', 'public/js/vue-event-queue.js').vue();
// mix.js('resources/assets/js/vue-event-lbcqueue.js', 'public/js/vue-event-lbcqueue.js').vue();
// mix.js('resources/assets/js/vue-event-hscqueue.js', 'public/js/vue-event-hscqueue.js').vue();
// mix.js('resources/assets/js/vue-announcement-form.js', 'public/js/vue-announcement-form.js').vue();
// mix.js('resources/assets/js/vue-announcement-queue.js', 'public/js/vue-announcement-queue.js').vue();
// mix.js('resources/assets/js/vue-archive-queue.js', 'public/js/vue-archive-queue.js').vue();
// mix.js('resources/assets/js/vue-magazine-builder.js', 'public/js/vue-magazine-builder.js').vue();
// mix.js('resources/assets/js/vue-story-queue.js', 'public/js/vue-story-queue.js').vue(); // NOT DONE!!!! CP 3/4/23
// mix.js('resources/assets/js/vue-story-form-wrapper.js', 'public/js/vue-story-form-wrapper.js').vue(); // NOT DONE!!!! CP 3/4/23
// mix.js('resources/assets/js/vue-expert-form.js', 'public/js/vue-expert-form.js').vue();

/*
|--------------------------------------------------------------------------
| Back End Styles
|--------------------------------------------------------------------------
|
| The styles that will appear on the restricted admin pages
|

/*
|--------------------------------------------------------------------------
| Back End Scripts
|--------------------------------------------------------------------------
|
| The scripts that will run on the restricted admin pages
|
*/

/*
|--------------------------------------------------------------------------
| Developmental
|--------------------------------------------------------------------------
*/
// Refresh page in local environment
// mix.browserSync('emutoday.test');

/*
|--------------------------------------------------------------------------
| CKEditor 5 Configuraiton (used in Vue frontend)
| Created by CP 3/17/23
| https://github.com/ckeditor/ckeditor5-vue/issues/23
| https://deniapps.com/blog/some-fixes-of-webpack-errors
|--------------------------------------------------------------------------
*/
const CKEditorWebpackPlugin = require('@ckeditor/ckeditor5-dev-webpack-plugin')
const CKEStyles = require('@ckeditor/ckeditor5-dev-utils').styles

//Includes SVGs and CSS files from "node_modules/ckeditor5-*" and any other custom directories
const CKEditorRegex = {
    svg: /ckeditor5-[^/\\]+[/\\]theme[/\\]icons[/\\][^/\\]+\.svg$/, //If you have any custom plugins in your project with SVG icons, include their path in this regex as well.
    css: /ckeditor5-[^/\\]+[/\\].+\.css$/,
};
// Keep comments un-ugly
mix.options({
    uglify: {
        comments: false
    }
});
// Configure CSS loaders to handle editor styles
mix.webpackConfig({
    devtool: "inline-source-map",
    module: {
        rules: [
            {
                test: /ckeditor5-[^/\\]+[/\\]theme[/\\]icons[/\\][^/\\]+\.svg$/,
                use: ['raw-loader']
            },
            {
                test: /ckeditor5-[^/\\]+[/\\]theme[/\\].+\.css/,
                use: [
                    {
                        loader: 'style-loader',
                        options: {
                            injectType: "singletonStyleTag",
                            attributes: {
                                'data-cke': true,
                            }
                        }
                    },
                    "css-loader",
                    {
                        loader: 'postcss-loader',
                        options: {
                            postcssOptions:
                                CKEStyles.getPostCssConfig({
                                themeImporter: {
                                    themePath: require.resolve('@ckeditor/ckeditor5-theme-lark')
                                },
                                minify: true
                            })
                        }
                    },
                ]
            }
        ]
    },
    plugins: [
        new CKEditorWebpackPlugin({
            language: 'en',
            addMainLanguageTranslationsToAllAssets: true
        })
    ]
});
//Exclude CKEditor regex from mix's default rules
mix.override(config => {
    const rules = config.module.rules;
    const targetSVG = (/(\.(png|jpe?g|gif|webp|avif)$|^((?!font).)*\.svg$)/).toString();
    const targetFont = (/(\.(woff2?|ttf|eot|otf)$|font.*\.svg$)/).toString();
    const targetCSS = (/\.p?css$/).toString();

    rules.forEach(rule => {
        let test = rule.test.toString();
        if ([targetSVG, targetFont].includes(rule.test.toString())) {
            rule.exclude = CKEditorRegex.svg;
        } else if (test === targetCSS) {
            rule.exclude = CKEditorRegex.css;
        }
    });
});
