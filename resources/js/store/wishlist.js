export default {
	state: {
		wishlist: []
	},
	mutations: {
		wishlist_set (state, payload) {
			state.wishlist = payload
		},
		wishlist_add (state, payload) {
			state.wishlist.push(payload)
		},
		wishlist_remove (state, payload) {
			const index = state.wishlist.indexOf(payload)
			if (index < 0)
				return false
			state.wishlist.splice(index, 1)
		}
	},
	getters: {
		wishlist: state => {
			return state.wishlist
		}
	}
}