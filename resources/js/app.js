import Vue from 'vue'
import App from './components/App'
import store from './store/index'
import initPlugins from './plugins/index'
import initComponents from './components/index'


const app = {
	render: h => h(App),
	store
}

initPlugins(app)
initComponents(app)

new Vue(app).$mount('#app')




/*import Vue from 'vue'
import axios from 'axios'
import Vuelidate from 'vuelidate'

import url from './plugins/url'
import toasts from './plugins/toasts'


axios.defaults.baseURL = document.querySelector('meta[name="base-url"]').getAttribute('content')
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
axios.defaults.headers.common['Accept'] = 'application/json'
axios.defaults.headers.post['Content-Type'] = 'application/json'


Vue.prototype.$http = axios
Vue.use(Vuelidate)

Vue.use(url)
Vue.use(toasts)


import components from './components'

const registerTemplates = (templates, dir) => {
	dir = (dir || '').toLowerCase()
	let prefix = ''
	if (dir.length) {
		prefix = dir.slice(1)
		prefix = prefix.split('')[0].toUpperCase() + prefix.slice(1)
	}
	
	templates.forEach((value, index) => {
		if (typeof value === 'string') {
			Vue.component(`${prefix}${value}Page`, require(`./components/templates${dir}/${value}`).default)
		}
		if (typeof value === 'object') {
			for (const key in value) {
				registerTemplates(value[key], `/${key}`)
			}
		}
	})
}

registerTemplates(components.templates)

import Breadcrumb from './components/theme/Breadcrumb'
import BreadcrumbItem from './components/theme/BreadcrumbItem'
import Checkbox from './components/theme/Checkbox'
import Radio from './components/theme/Radio'
import HasScroll from './components/theme/HasScroll'
import Sticky from './components/theme/Sticky'
import Laradata from './components/theme/Laradata'

import SectionHeader from './components/sections/Header'
import SectionCart from './components/sections/cart'
import SectionWelcome from './components/sections/Welcome'
import SectionCollections from './components/sections/Collections'
import SectionSearch from './components/sections/Search'
import SectionLegalRefund from './components/sections/LegalRefund'
import SectionFooter from './components/sections/Footer'

import SnippetCatalogCollectionProduct from './components/snippets/CatalogCollectionProduct'
import SnippetCatalogCollectionFilters from './components/snippets/CatalogCollectionFilters'

import JivoMixin from './components/mixins/JivoMixin'


Vue.component('breadcrumb', Breadcrumb)
Vue.component('breadcrumb-item', BreadcrumbItem)
Vue.component('checkbox', Checkbox)
Vue.component('radio', Radio)
Vue.component('has-scroll', HasScroll)
Vue.component('sticky', Sticky)
Vue.component('laradata', Laradata)

Vue.component('section-header', SectionHeader)
Vue.component('section-cart', SectionCart)
Vue.component('section-welcome', SectionWelcome)
Vue.component('section-collections', SectionCollections)
Vue.component('section-search', SectionSearch)
Vue.component('section-legal-refund', SectionLegalRefund)
Vue.component('section-footer', SectionFooter)

Vue.component('snippet-catalog-collection-product', SnippetCatalogCollectionProduct)
Vue.component('snippet-catalog-collection-filters', SnippetCatalogCollectionFilters)

Vue.mixin(JivoMixin)


import App from './components/App'
import store from './store/index'

const app = new Vue({
	el: '#app',
	render: h => h(App),
	store
})*/