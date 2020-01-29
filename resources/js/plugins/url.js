export default (app, inject) => {

	const plugin = {
		instance: null,
		getInstance () {
			if (this.instance === null)
				this.instance = new URL(window.location.href)

			return this.instance
		},
		current () {
			return this.getInstance().href
		},
		path () {
			return window.location.pathname
		},
		params () {
			const raw = decodeURI(window.location.search)

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
		getParam (paramName) {
			return this.getInstance().searchParams.get(paramName)
		},
		hasParam (paramName) {
			return this.getInstance().searchParams.has(paramName)
		},
		setParam (paramName, paramValue) {
			this.getInstance().searchParams.set(paramName, paramValue)
			return this.current()
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