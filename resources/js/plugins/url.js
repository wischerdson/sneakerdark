export default (app, inject) => {
	const plugin = {
		current () {
			return window.location.origin + window.location.pathname
		},
		path () {
			return window.location.pathname
		},
		params () {
			const raw = window.location.search

			if (!raw)
				return {}

			let result = {}
			const params = (raw.substr(1)).split('&')
			
			for (const key in params) {
				const option = params[key].split('=')
				result[option[0]] = option[1]
			}

			return result
		},
		setParams (array) {
			let query = this.current()
			let fst = true
			for (const key in array) {
				if (fst) {
					query += '?'
					fst = false
					query += key + '=' + array[key]
					continue
				}
				query += '&' + key + '=' + array[key]
			}

			return query
		}
	}

	inject('url', plugin);
}