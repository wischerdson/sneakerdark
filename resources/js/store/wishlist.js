export default {
	state: {
		wishlist: []
	},
	mutations: {
		wishlistSet (state, payload) {
			state.wishlist = payload
		},
		wishlistAdd (state, payload) {
			state.wishlist.push(payload)
		},
		wishlistRemove (state, payload) {
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