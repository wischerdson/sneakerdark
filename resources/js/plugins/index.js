import Vue from 'vue'

export default (app) => {
	let inject = (name, plugin) => {
		let key = `$${name}`
		app[key] = plugin
		app.store[key] = plugin

		Vue.use(() => {
			if (Vue.prototype.hasOwnProperty(key)) {
				return
			}

			Object.defineProperty(Vue.prototype, key, {
				get () {
					return this.$root.$options[key]
				}
			})
		})
	}

	require('./axios').default(app, inject)
	require('./url').default(app, inject)
	require('./jivo').default(app, inject)
	require('./toasts').default(app, inject)
	require('./error').default(app, inject)
}