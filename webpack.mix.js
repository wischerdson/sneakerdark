const mix = require('laravel-mix')


mix.setPublicPath('public_html/')


if (mix.inProduction()) {
    mix.version();
    mix.options({
		postCss: [
			require('cssnano')({
				preset: ['default', {
					discardComments: {
						removeAll: true,
					},
				}]
			}),
			require("css-mqpacker")(),
			require('autoprefixer')
		]
	});
}

mix.less('resources/less/app.less', 'css')
mix.js('resources/js/app.js', 'js/v-app.js')
mix.combine([
	'resources/js/modules/jquery.min.js',
	'resources/js/modules/bootstrap.min.js',
	'resources/js/modules/materialize.min.js',
	'resources/js/modules/materialize.anime.min.js',
	'resources/js/modules/materialize.cash.js',
	'resources/js/modules/materialize.toasts.js',
	'resources/js/modules/slick.js',
	'public_html/js/v-app.js'
], 'public_html/js/app.js')

// mix.browserSync('socialrate.ru');
// mix.disableNotifications();