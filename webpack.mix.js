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
// mix.sass('resources/assets/sass/public-app.scss', 'public/js/zfoundation222.css')

// Combine all the front-end styles into one stylesheet
mix.combine([
	'resources/assets/css/zfoundation.css',
	'resources/assets/css/main-styles.css',
	'resources/assets/css/story-styles.css',
	'resources/assets/css/magazine-styles.css',
	'resources/assets/css/experts-styles.css',
	'resources/assets/css/media-queries.css',
	'resources/assets/css/basebar-styles.css',
	'resources/assets/css/tweeks.css',
	'resources/assets/css/ckeditor5-styles.css',
	'resources/assets/css/emu175.css',
	'resources/assets/css/insideemu-styles.css',
], 'public/css/public-styles.css').version()

/*
|--------------------------------------------------------------------------
| Front End Scripts
|--------------------------------------------------------------------------
|
| The scripts that will run on the public facing pages
|
*/
mix.combine([
	'resources/assets/js/vendor-public/jquery.min.js',
	'node_modules/foundation-sites/dist/js/foundation.min.js',
	'node_modules/magnific-popup/dist/jquery.magnific-popup.js',
	'resources/assets/js/app.js'
], 'public/js/public-scripts.js').version();


// Compile vue files
// mix.js('resources/assets/js/vue-announcement-form.js', 'public/js/vue-announcement-form.js').vue().version();
// mix.js('resources/assets/js/vue-announcement-queue.js', 'public/js/vue-announcement-queue.js').vue().version();
// mix.js('resources/assets/js/vue-archive-queue.js', 'public/js/vue-archive-queue.js').vue().version();
// mix.js('resources/assets/js/vue-author-form.js', 'public/js/vue-author-form.js').vue().version();
// mix.js('resources/assets/js/vue-caleventview.js', 'public/js/vue-caleventview.js').vue().version();
mix.js('resources/assets/js/vue-email-form.js', 'public/js/vue-email-form.js').vue().version();
// mix.js('resources/assets/js/vue-event-form.js', 'public/js/vue-event-form.js').vue().version();
// mix.js('resources/assets/js/vue-event-hscqueue.js', 'public/js/vue-event-hscqueue.js').vue().version();
// mix.js('resources/assets/js/vue-event-lbcqueue.js', 'public/js/vue-event-lbcqueue.js').vue().version();
// mix.js('resources/assets/js/vue-event-queue.js', 'public/js/vue-event-queue.js').vue().version();
// mix.js('resources/assets/js/vue-expert-form.js', 'public/js/vue-expert-form.js').vue().version();
// mix.js('resources/assets/js/vue-expert-list.js', 'public/js/vue-expert-list.js').vue().version();
// mix.js('resources/assets/js/vue-expert-request-list.js', 'public/js/vue-expert-request-list.js').vue().version();
// mix.js('resources/assets/js/vue-expertcategory-form.js', 'public/js/vue-expertcategory-form.js').vue().version();
// mix.js('resources/assets/js/vue-expertmediarequest-form.js', 'public/js/vue-expertmediarequest-form.js').vue().version();
// mix.js('resources/assets/js/vue-expertspeakerrequest-form.js', 'public/js/vue-expertspeakerrequest-form.js').vue().version();
// mix.js('resources/assets/js/vue-magazine-builder.js', 'public/js/vue-magazine-builder.js').vue().version();
// mix.js('resources/assets/js/vue-mediahighlight-form.js', 'public/js/vue-mediahighlight-form.js').vue().version();
// mix.js('resources/assets/js/vue-oauth-clients.js', 'public/js/vue-oauth-clients.js').vue().version();
// mix.js('resources/assets/js/vue-oauth-authorized-clients.js', 'public/js/vue-oauth-authorized-clients.js').vue().version();
// mix.js('resources/assets/js/vue-oauth-personal-access-tokens.js', 'public/js/vue-oauth-personal-access-tokens.js').vue().version();
// mix.js('resources/assets/js/vue-page-form.js', 'public/js/vue-page-form.js').vue().version();
// mix.js('resources/assets/js/vue-search-form.js', 'public/js/vue-search-form.js').vue().version();
// mix.js('resources/assets/js/vue-search-form-offcanvas.js', 'public/js/vue-search-form-offcanvas.js').vue().version();
// mix.js('resources/assets/js/vue-story-form-wrapper.js', 'public/js/vue-story-form-wrapper.js').vue().version();
// mix.js('resources/assets/js/vue-story-queue.js', 'public/js/vue-story-queue.js').vue().version();
// mix.js('resources/assets/js/vue-storyideas-form.js', 'public/js/vue-storyideas-form.js').vue().version();
// mix.js('resources/assets/js/vue-storyideas-list.js', 'public/js/vue-storyideas-list.js').vue().version();
// mix.js('resources/assets/js/vue-emu-175.js', 'public/js/vue-emu-175.js').vue().version().version();


mix.js('resources/assets/js/vue-insideemu-queue.js', 'public/js/vue-insideemu-queue.js').vue().version().version();
mix.js('resources/assets/js/vue-insideemu-post-form.js', 'public/js/vue-insideemu-post-form.js').vue().version().version();
mix.js('resources/assets/js/vue-insideemu-user-idea-form.js', 'public/js/vue-insideemu-user-idea-form.js').vue().version().version();
mix.js('resources/assets/js/vue-insideemu-user-ideas.js', 'public/js/vue-insideemu-user-ideas.js').vue().version().version();
mix.js('resources/assets/js/vue-insideemu-admin-dashboard.js', 'public/js/vue-insideemu-admin-dashboard.js').vue().version().version();
mix.js('resources/assets/js/vue-insideemu-admin-idea-view.js', 'public/js/vue-insideemu-admin-idea-view.js').vue().version().version();
mix.js('resources/assets/js/vue-insideemu-ideas-queue.js', 'public/js/vue-insideemu-ideas-queue.js').vue().version().version();

/*
|--------------------------------------------------------------------------
| Back End Styles
|--------------------------------------------------------------------------
|
| The styles that will appear on the restricted admin pages
|
*/
mix.styles([
	'resources/assets/css/admin-less.css',
	'resources/assets/css/admin.css',
	'resources/assets/css/insideemu-styles.css'
], 'public/css/admin-styles.css').version();
/*
|--------------------------------------------------------------------------
| Back End Scripts
|--------------------------------------------------------------------------
|
| The scripts that will run on the restricted admin pages
|
*/
mix.js('resources/assets/js/admin-emucustom.js', 'public/js/admin-emucustom.js').vue().version();

/*
|--------------------------------------------------------------------------
| Developmental
|--------------------------------------------------------------------------
*/
// Refresh page in local environment
// mix.browserSync('localhost:8080');

/*
|--------------------------------------------------------------------------
| CKEditor 5 Configuration (used in Vue frontend)
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
	stats: {
		children: true
	},
	devtool: "inline-source-map",
	module: {
		rules: [
			{
				test: /\.s[ac]ss$/i,
				use: [
					{
						loader: 'sass-loader',
						options: {
							implementation: require('node-sass'),
						},
					},
				],
			},
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
		}
		else if (test === targetCSS) {
			rule.exclude = CKEditorRegex.css;
		}
	});
});
