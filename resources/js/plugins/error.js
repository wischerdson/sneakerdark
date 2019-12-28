export default (app, inject) => {
	const plugin = (error) => {
		console.log(error)
		app.$toast.error()
	}

	inject('error', plugin)
}