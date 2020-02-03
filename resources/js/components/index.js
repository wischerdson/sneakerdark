import Vue from 'vue'
import components from '../components.js'

export default (app) => {
	const register = (components, dir) => {
		dir = (dir || '').toLowerCase()
		
		if (typeof components === 'string') {
			let element = components
			let prefixArray = dir.split('/').slice(2)
			let prefix = ''

			for (const key in prefixArray) {
				let value = prefixArray[key]
				let valueS = value.split('')
				value = valueS[0].toUpperCase() + value.slice(1)
				prefix += value
			}


			if ((/^\&/gmi).test(element)) {
				components = components.slice(1)
				element = prefix + element.slice(1)
			}

			if ((/templates/gmi).test(dir))
				element += 'Page'
			if ((/sections/gmi).test(dir))
				element = `Section${element}`

			Vue.component(element, require(`.${dir}/${components}.vue`).default)
		}

		for (const key in components) {
			const value = components[key]

			if (typeof value === 'object') {
				for (const key_ in value) {
					register(value[key_], `${dir}/${key}`)
				}
			}
		}
	}

	register(components)
}