import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
	modules: {
		cart: require('./cart').default,
		wishlist: require('./wishlist').default,
		search: require('./search').default,
		collection: require('./collection').default
	},
	state: {
		laradata: {}
	},
	mutations: {
		addLaradata (state, {key, value}) {
			state.laradata[key] = value
		}
	}
})