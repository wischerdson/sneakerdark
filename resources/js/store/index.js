import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
	modules: {
		wishlist: require('./wishlist').default,
		search: require('./search').default,
		collection: require('./collection').default,
		storage: require('./_storage').default,
	},
	state: {
		laradata: {},
		cartIsOpen: false,
		cart: {}
	},
	mutations: {
		cartIsOpen (state, payload) {
			state.cartIsOpen = payload
		},
		cart (state, payload) {
			state.cart = {}
			state.cart = payload
		},
		addLaradata (state, {key, value}) {
			state.laradata[key] = value
		}
	},
	getters: {
		cart (state) {
			return state.cart
		}
	},
	actions: {
		
	}
})