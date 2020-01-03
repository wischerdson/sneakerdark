export default (app, inject) => {
	const plugin = {
		extract (storageType, data) {
			let itemJson = storageType.getItem(data.name)
			
			if (itemJson) {
				data.name = data.alias || data.name
				return JSON.parse(itemJson)
			}

			this.set(storageType, {
				name: data.name,
				value: data.default
			})

			return data.default
		},
		set (storageType, data) {
			storageType.setItem(data.name, JSON.stringify(data.value))
		}
	}

	inject('storage', plugin)
}