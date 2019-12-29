export default {
	state: {
		collection_filters: {},
		catalog: {},
		
		collection_pagination: {},
		catalogWait: false,
		sort: 1,

		collection_products: {},
		collection_firstLoad: true,
		collection_wait: false,
		collection_total: 0,
		collection_totalSubject: 'товаров'
	},
	mutations: {
		collection_filters (state, payload) {
			state.collection_filters = payload
		},
		collection_products (state, payload) {
			state.collection_products = payload
		},
		collection_pagination (state, payload) {
			state.collection_pagination = payload
		},
		collection_wait (state, payload) {
			state.collection_wait = payload
		},
		collection_firstLoad (state, payload) {
			state.collection_firstLoad = false
		},
		collection_total (state, payload) {
			state.collection_total = payload
		},
		collection_totalSubject (state, payload) {
			state.collection_totalSubject = payload
		}
	},
	getters: {
		collection_products (state) {
			return state.collection_products
		},
		collection_filters: state => {
			return state.collection_filters
		},
		collection_pagination (state) {
			return state.collection_pagination
		},
		collection_wait (state) {
			return state.collection_wait
		},
		collection_firstLoad (state) {
			return state.collection_firstLoad
		},
		collection_total (state) {
			return state.collection_total
		},
		collection_totalSubject (state) {
			return state.collection_totalSubject
		}
	},
	actions: {
		async collection_fetch (context, data) {
			context.commit('collection_wait', true)

			await this.$axios.get(data.api, {
				params: data.params
			}).then(response => response.data).then((data) => {
				data = data.data
				context.commit('collection_filters', data.filter_list)
				context.commit('collection_products', data.products)
				context.commit('collection_pagination', data.pagination)
				context.commit('collection_total', data.total)
				context.commit('collection_totalSubject', data.total_subject)
			}).catch(({response}) => {
				this.$error(response)
  			}).finally(() => {
				context.commit('collection_wait', false)
				context.commit('collection_firstLoad')
			})
		}
	}
}