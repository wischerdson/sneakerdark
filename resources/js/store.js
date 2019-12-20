import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
	state: {
		searchIsOpen: false,
		searchQuery: '',
		cartIsOpen: false,
		cart: {},
		filters: {},
		catalog: {},
		products: {},
		pagination: {},
		laradata: {}
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
		},
		updateCatalog (state, payload) {
			state.catalog = payload
		},
		updateFilters (state, payload) {
			state.filters = payload
		},
		updateProducts (state, payload) {
			state.products = payload
		},
		updatePagination (state, payload) {
			state.pagination = payload
		},
		addLaradata (state, {key, value}) {
			state.laradata[key] = value
		}
	},
	getters: {
		getCart: state => () => state.cart,
		getCatalog: state => {
			return state.catalog
		},
		getProducts: state => {
			return state.products
		},
		getFilters: state => {
			return state.filters
		},
		getPagination: state => {
			return state.pagination
		},
		laradata: state => {
			return state.laradata
		}
	},
	actions: {
		async fetchCatalog (context, data) {
			await axios.get(data.api, {
				params: {
					page: data.page,
					filters: data.filters
				}
			}).then(response => response.data).then(data => {
				context.commit('updateCatalog', data.data)
				context.commit('updateFilters', data.data.filters)
				context.commit('updateProducts', data.data.products)
				context.commit('updatePagination', data.data.pagination)
			}, err => {
				console.log(err)
				M.toast({html: 'Произошла ошибка', classes: 'error-toast'})
			})
		}
	}
});