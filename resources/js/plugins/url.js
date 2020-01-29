export default (app, inject) => {

	const plugin = {
		origin: null,
		href: null,
		host: null,
		protocol: null,
		pathname: null,
		search: null,
		params: [],

		__construct () {
			this.origin = window.location.origin
			this.href = window.location.href
			this.host = window.location.host
			this.protocol = window.location.protocol
			this.search = decodeURI(window.location.search)
			this.pathname = window.location.pathname
			this.params = this.initParams()
		},
		initParams () {
			let result = {}

			if (!this.search)
				return result
			
			const params = this.search.substr(1).split('&')
			
			for (const key in params) {
				const option = params[key].split('=')
				result[option[0]] = option[1]
			}

			return result
		},
		setParams (params, remember) {
			remember = remember === undefined ? true : remember
			if (remember)
				Object.assign(this.params, params)
			return this.createSearch(Object.assign({}, this.params, params), remember)
		},
		setParam (paramName, paramValue, remember) {
			remember = remember === undefined ? true : remember
			let a = {}
			a[paramName] = paramValue
			return this.setParams(a, remember)
		},
		hasParam (paramName) {
			return paramName in this.params
		},
		getParam (paramName) {
			return this.params[paramName]
		},
		createSearch (params, remember) {
			let result = this.origin + this.pathname + '?'
			let amp = ''

			for (const key in params) {
				result += amp + key + '=' + params[key]
				amp = '&'
			}

			result = encodeURI(result)

			this.href = remember ? result : this.href

			return result
		}
	}

	inject('url', plugin);
}