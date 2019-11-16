import Vue from 'vue'
import Vuex from 'vuex'
import VueResource from 'vue-resource'

Vue.use(Vuex)
Vue.use(VueResource)

export default new Vuex.Store({
	state: {
		searchIsOpen: false,
		searchQuery: '',
		cartIsOpen: false,
		cart: {}
	},
	mutations: {
		searchIsOpen (state, payload) {
			state.searchIsOpen = payload
		},
		searchQuery (state, payload) {
			state.searchQuery = payload
		},
		cartIsOpen (state, payload) {
			state.cartIsOpen = payload
		},
		cart (state, payload) {
			state.cart = {}
			state.cart = payload
		}
	},
	getters: {
		getCart: state => () => state.cart
	},
	actions: {
		
	}
});