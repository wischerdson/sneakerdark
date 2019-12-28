export default (app, inject) => {
	const plugin = {
		open () {
			window.jivo_api.open(); 
		}
	}

	inject('jivo', plugin);
}