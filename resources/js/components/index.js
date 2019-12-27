import Vue from 'vue'
import components from '../components.js'

export default (app) => {
	const registerTemplates = (templates, dir) => {
		dir = (dir || '').toLowerCase()
		let prefix = ''
		if (dir.length) {
			prefix = dir.slice(1)
			prefix = prefix.split('')[0].toUpperCase() + prefix.slice(1)
		}
		
		templates.forEach((value, index) => {
			if (typeof value === 'string') {
				Vue.component(`${prefix}${value}Page`, require(`./templates${dir}/${value}`).default)
			}
			if (typeof value === 'object') {
				for (const key in value) {
					registerTemplates(value[key], `/${key}`)
				}
			}
		})
	}

	registerTemplates(components.templates)
}