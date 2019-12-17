import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import Vuelidate from 'vuelidate'


axios.defaults.baseURL = document.querySelector('meta[name="base-url"]').getAttribute('content')
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
axios.defaults.headers.common['Accept'] = 'application/json'
axios.defaults.headers.post['Content-Type'] = 'application/json'


Vue.prototype.$http = axios
Vue.use(Vuelidate)
Vue.use(Vuex)


import Breadcrumb from './components/theme/Breadcrumb'
import BreadcrumbItem from './components/theme/BreadcrumbItem'
import Checkbox from './components/theme/Checkbox'
import HasScroll from './components/theme/HasScroll'
import Sticky from './components/theme/Sticky'

import SectionHeader from './components/sections/Header'
import SectionCart from './components/sections/cart'
import SectionWelcome from './components/sections/Welcome'
import SectionCollections from './components/sections/Collections'
import SectionBrands from './components/sections/Brands'
import SectionSearch from './components/sections/Search'
import SectionLegalRefund from './components/sections/LegalRefund'
import SectionFooter from './components/sections/Footer'

import SearchResult from './components/snippets/SearchResult'
import SnippetCatalogCollectionProduct from './components/snippets/CatalogCollectionProduct'
import SnippetCatalogCollectionFilters from './components/snippets/CatalogCollectionFilters'

import JivoMixin from './components/mixins/JivoMixin'


Vue.component('breadcrumb', Breadcrumb)
Vue.component('breadcrumb-item', BreadcrumbItem)
Vue.component('checkbox', Checkbox)
Vue.component('has-scroll', HasScroll)
Vue.component('sticky', Sticky)

Vue.component('section-header', SectionHeader)
Vue.component('section-cart', SectionCart)
Vue.component('section-welcome', SectionWelcome)
Vue.component('section-collections', SectionCollections)
Vue.component('section-brands', SectionBrands)
Vue.component('section-search', SectionSearch)
Vue.component('section-legal-refund', SectionLegalRefund)
Vue.component('section-footer', SectionFooter)

Vue.component('snippet-search-result', SearchResult)
Vue.component('snippet-catalog-collection-product', SnippetCatalogCollectionProduct)
Vue.component('snippet-catalog-collection-filters', SnippetCatalogCollectionFilters)

Vue.mixin(JivoMixin)


import App from './components/App'
import store from './store'

const app = new Vue({
	el: '#app',
	render: h => h(App),
	store
})