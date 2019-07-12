const mix = require('laravel-mix');

/*const LessPluginCleanCSS = require('less-plugin-clean-css');
const LessPluginAutoPrefix = require('less-plugin-autoprefix');
let autoprefixPlugin = new LessPluginAutoPrefix({
	browsers: ['last 2 versions'],
	cascade: false
});
let cleanCSSPlugin = new LessPluginCleanCSS({
	advanced: true,
	level: {
		1: {
			specialComments: 0
		}
	}
});*/

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

mix.less('resources/less/home.less', 'public/css');
