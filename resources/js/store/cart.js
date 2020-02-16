import Vue from 'vue'

export default {
	state: {
		cart: {},
		cart_isOpen: false,
		cart_wait: false
	},
	mutations: {
		cart_set (state, payload) {
			state.cart = payload
		},
		cart_add (state, payload) {
			if (state.cart.hasOwnProperty(payload.id)) {
				console.log(state.cart[payload.id].quantity++)
			} else {
				Vue.set(state.cart, payload.id, {
					quantity: 1,
					size: payload.size
				})
			}
		},
		cart_remove (state, payload) {
			if (state.cart.hasOwnProperty(payload)) {
				delete state.cart[payload]
			}
		},
		cart_open (state) {
			state.cart_isOpen = true
		},
		cart_close (state) {
			state.cart_isOpen = false
		},
		cart_wait (state, payload) {
			state.cart_wait = payload
		}
	},
	getters: {
		cart (state) {
			return state.cart
		},
		cart_isOpen (state) {
			return state.cart_isOpen
		},
		cart_wait (state) {
			return state.cart_wait
		}
	},
	actions: {
		async cart (context, data) {
			context.commit('cart_wait', true)

			await this.$axios.get(data.url, {
				params: data.params
			}).then(response => response.data.data).then((data) => {
				context.commit('cart_set', data)
			}).catch(({response}) => {
				this.$error(response)
  			}).finally(() => {
				context.commit('cart_wait', false)
			})
		},
		async cart_store (context, data) {
			await this.$axios.post(data.url, {
				params: data.params
			}).then(response => response.data).then((data) => {
				console.log(data)
			})
		}
	}
}