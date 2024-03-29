export default {
	state: {
		search_wait: false,
		search_total: 0,
		search_totalSubject: '',
		search: {
			q: '',
			gender: ''
		},
		search_results: [],
		search_open: false
	},
	mutations: {
		search_wait (state, payload) {
			state.search_wait = payload
		},
		search_total (state, payload) {
			state.search_total = payload
		},
		search_totalSubject (state, payload) {
			state.search_totalSubject = payload
		},
		search_open (state) {
			state.search_open = true
		},
		search_close (state) {
			state.search_open = false
		},
		search (state, payload) {
			state.search = payload
		},
		search_results (state, payload) {
			state.search_results = payload
		}
	},
	getters: {
		search_isOpen (state) {
			return state.search_open
		},
		search (state) {
			return state.search
		},
		search_isWait (state) {
			return state.search_wait
		},
		search_results (state) {
			return state.search_results
		},
		search_total (state) {
			return state.search_total
		},
		search_totalSubject (state) {
			return state.search_totalSubject
		}
	},
	actions: {
		async search (context, {url, params}) {
			context.commit('search_wait', true)

			await this.$axios.get(url, {params}).then(response => response.data.data).then((data) => {
				context.commit('search_results', data.products)
				context.commit('search_total', data.count)
				context.commit('search_totalSubject', data.subject)
			}).catch(({response}) => {
				this.$error(response)
  			}).finally(function () {
				context.commit('search_wait', false)
			})
		}
	}
}