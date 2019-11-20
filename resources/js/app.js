import Vue from 'vue'
import VueResource from 'vue-resource'
import Vuelidate from 'vuelidate'

Vue.use(VueResource)
Vue.use(Vuelidate)

Vue.http.headers.common['X-CSRF-TOKEN'] = _token

import store from './store'

import App from './components/App'


import Breadcrumb from './components/theme/Breadcrumb'
import BreadcrumbItem from './components/theme/BreadcrumbItem'

Vue.component('breadcrumb', Breadcrumb)
Vue.component('breadcrumb-item', BreadcrumbItem)


import SectionHeader from './components/sections/Header'
import SectionCart from './components/sections/cart'
import SectionWelcome from './components/sections/Welcome'
import SectionCollections from './components/sections/Collections'
import SectionSearch from './components/sections/Search'
import SectionFooter from './components/sections/Footer'

Vue.component('section-header', SectionHeader)
Vue.component('section-cart', SectionCart)
Vue.component('section-welcome', SectionWelcome)
Vue.component('section-collections', SectionCollections)
Vue.component('section-search', SectionSearch)
Vue.component('section-footer', SectionFooter)


import SearchResult from './components/snippets/SearchResult'

Vue.component('snippet-search-result', SearchResult)



import JivoMixin from './components/mixins/JivoMixin'
Vue.mixin(JivoMixin)

const app = new Vue({
	el: '#app',
	render: h => h(App),
	store
});