const mix = require('laravel-mix')

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
mix.js('resources/js/app.js', 'js/app.js')
/*mix.combine([
	'resources/js/modules/jquery.min.js',*/
	//'resources/js/modules/bootstrap.min.js',
	/*'resources/js/modules/materialize.min.js',
	'resources/js/modules/materialize.anime.min.js',
	'resources/js/modules/materialize.cash.js',
	'resources/js/modules/materialize.toasts.js',
	//'resources/js/modules/slick.js',
	'public/js/v-app.js'
], 'public/js/app.js')*/

// mix.browserSync('sneakerdark.loc');
mix.disableNotifications();