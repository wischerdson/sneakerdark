import Vue from 'vue'
import Vuex from 'vuex'

import wishlist from './wishlist'
import search from './search'
import collection from './collection'

Vue.use(Vuex)

export default new Vuex.Store({
	modules: {
		wishlist,
		search,
		collection
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