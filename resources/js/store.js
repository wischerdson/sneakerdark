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
		laradata: {},
		catalogWait: false
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
		},
		catalogWait (state) {
			state.catalogWait = false
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
		}
	},
	actions: {
		async fetchCatalog (context, data) {
			await axios.get(data.api, {
				params: {
					page: data.page,
					filters: data.filters
				}
			}).then(response => response.data).then((data) => {
				data = data.data
				//console.log(data)
				context.commit('updateCatalog', data)
				context.commit('updateFilters', data.filters)
				context.commit('updateProducts', data.products)
				context.commit('updatePagination', data.pagination)
			}).catch((error) => {
				console.log(error.response)
				M.toast({html: 'Произошла ошибка', classes: 'error-toast'})
  			}).finally(function () {
				context.commit('catalogWait')
			}); 
		}
	}
});