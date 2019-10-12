import Vue from 'vue'
import VueResource from 'vue-resource'
import Vuelidate from 'vuelidate'

Vue.use(VueResource)
Vue.use(Vuelidate)

Vue.http.headers.common['X-CSRF-TOKEN'] = _token

import store from './store'

import App from './components/App'


import SectionHeader from './components/sections/Header'
import SectionWelcome from './components/sections/Welcome'
import SectionCollections from './components/sections/Collections'
import SectionFooter from './components/sections/Footer'

Vue.component('section-header', SectionHeader)
Vue.component('section-welcome', SectionWelcome)
Vue.component('section-collections', SectionCollections)
Vue.component('section-footer', SectionFooter)

const app = new Vue({
	el: '#app',
	render: h => h(App),
	store
}); 