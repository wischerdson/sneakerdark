import Vue from 'vue'
import Vuex from 'vuex'

import url from './plugins/url'

import collection from './collection'

Vue.use(Vuex)
Vue.use(url)

export default new Vuex.Store({
	modules: {
		collection
	}
})