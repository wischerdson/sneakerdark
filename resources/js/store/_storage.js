export default {
	state: {
		storage: {

		}
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
		storage_add (state, payload) {
			let itemJson = payload.storage.getItem(payload.name)

			let item = []
			if (itemJson) {
				item = JSON.parse(itemJson)
			}
			item.push(payload.value)
			state.storage[payload.name] = item
			payload.storage.setItem(payload.name, JSON.stringify(item))
			
		},
		storage_set (state, payload) {
			state.storage[payload.alias] = payload.value
			payload.storage.setItem(payload.name, JSON.stringify(payload.value))
		},
		storage_extract (state, payload) {
			state.storage[payload.name] = payload.value
		}
	},
	getters: {
		storage (state) {
			return state.storage
		}
	},
	actions: {
		storage_extract (context, data) {
			let itemJson = data.storage.getItem(data.name)
			
			if (itemJson) {
				data.name = data.alias || data.name
				data.value = JSON.parse(itemJson)
				context.commit('storage_extract', data)
			} else {
				data.value = data.default
				context.commit('storage_set', data)
			}
		}
	}
}