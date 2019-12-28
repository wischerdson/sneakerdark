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