
export default {
	install (Vue, options) {
		Vue.prototype.$error = (error) => {
			M.toast({html: 'Произошла ошибка', classes: 'error-toast'})
			console.log(error)
		}
	}
}
