import axios from 'axios';

export default (app, inject) => {
	axios.defaults.baseURL = document.querySelector('meta[name="base-url"]').getAttribute('content')
	axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
	axios.defaults.headers.common['Accept'] = 'application/json'
	axios.defaults.headers.post['Content-Type'] = 'application/json'

	inject('axios', axios);
}