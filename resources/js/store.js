import Vue from 'vue'
import Vuex from 'vuex'
import VueResource from 'vue-resource'

Vue.use(Vuex)
Vue.use(VueResource)

export default new Vuex.Store({
	state: {
		searchIsOpen: true,
		searchQuery: ''
	},
	mutations: {
		searchIsOpen (state, payload) {
			state.searchIsOpen = payload
		},
		searchQuery (state, payload) {
			state.searchQuery = payload
		}
	},
	getters: {
		
	},
	actions: {
		
	}
});