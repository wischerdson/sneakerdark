export default {
	state: {
		availableFilters: {

		},
		appliedFilters: {
			category: [],
			gender: [],
			brand: [],
			price: []
		},
		productList: {

		},
		pagination: {

		},
		wait: false
	},
	getters: {

	},
	mutations: {
		availableFilters (state, payload) {
			state.availableFilters = payload
		},
		appliedFilters (state, payload) {
			/*localStorage.setItem(`filters_conf_${this.$url.path()}`, JSON.stringify(payload))
			state.appliedFilters = payload*/
		},
		productList (state, payload) {
			state.productList = payload
		},
		pagination (state, payload) {
			state.pagination = payload
		},
		wait (state, payload) {
			state.wait = payload
		},
	},
	actions: {

	}
}