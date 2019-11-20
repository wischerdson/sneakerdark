import Vue from 'vue'
import VueResource from 'vue-resource'
import Vuelidate from 'vuelidate'

import Breadcrumb from './components/theme/Breadcrumb'
import BreadcrumbItem from './components/theme/BreadcrumbItem'

import SectionHeader from './components/sections/Header'
import SectionCart from './components/sections/cart'
import SectionWelcome from './components/sections/Welcome'
import SectionCollections from './components/sections/Collections'
import SectionSearch from './components/sections/Search'
import SectionFooter from './components/sections/Footer'

import SearchResult from './components/snippets/SearchResult'

import JivoMixin from './components/mixins/JivoMixin'

import store from './store'

import App from './components/App'

Vue.use(VueResource)
Vue.use(Vuelidate)

Vue.http.headers.common['X-CSRF-TOKEN'] = _token

Vue.component('breadcrumb', Breadcrumb)
Vue.component('breadcrumb-item', BreadcrumbItem)

Vue.component('section-header', SectionHeader)
Vue.component('section-cart', SectionCart)
Vue.component('section-welcome', SectionWelcome)
Vue.component('section-collections', SectionCollections)
Vue.component('section-search', SectionSearch)
Vue.component('section-footer', SectionFooter)

Vue.component('snippet-search-result', SearchResult)

Vue.mixin(JivoMixin)

const app = new Vue({
	el: '#app',
	render: h => h(App),
	store
})