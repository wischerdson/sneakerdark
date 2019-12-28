export default (app, inject) => {
	const plugin = {
		error () {
			M.toast({html: 'Произошла ошибка', classes: 'error-toast'})
		}
	}

	inject('toast', plugin)
}