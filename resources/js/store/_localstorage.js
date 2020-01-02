export default {
	state: {
		localstorage: {}
	},
	mutations: {
		/*
			Only for Arrays!

			For example:
				this.$store.commit('localstorage_add', {
					localstorage,
					name: 'wishlist',
					value: '15'
				})
		*/
		localstorage_add (state, payload) {
			let itemJson = payload.localStorage.getItem(payload.name)

			let item = []
			if (itemJson) {
				item = JSON.parse(itemJson)
			}
			item.push(payload.value)
			state.localstorage[payload.name] = item
			payload.localStorage.setItem(payload.name, JSON.stringify(item))
			
		},
		localstorage_set(state, payload) {
			state.localstorage[payload.alias || payload.name] = payload.value
			payload.localStorage.setItem(payload.name, JSON.stringify(payload.value))
		},
		localstorage_extract (state, payload) {
			let itemJson = payload.localStorage.getItem(payload.name)
			if (itemJson) {
				state.localstorage[payload.alias || payload.name] = JSON.parse(itemJson)
			} else {
				payload.localStorage.setItem(payload.name, JSON.stringify(payload.default))
				state.localstorage[payload.alias || payload.name] = payload.default
			}
		}
	},
	getters: {
		localstorage (state) {
			console.log(state)
			return state.localstorage
		}
	}
}