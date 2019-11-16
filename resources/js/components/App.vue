<script type="text/javascript">
	
	import HomePage from './templates/Home'
	import SearchPage from './templates/Search'
	import CatalogProductPage from './templates/catalog/Product'
	import CatalogProductNotFoundPage from './templates/catalog/ProductNotFound'
	import CatalogPage from './templates/catalog/Collection'

	export default {
		template: '#template__layout',
		components: {
			HomePage,
			SearchPage,
			CatalogPage,
			CatalogProductPage,
			CatalogProductNotFoundPage
		},
		// computed: {
		// 	cart () {
		// 		return this.$store.state.cart
		// 	}
		// },
		// watch: {
		// 	cart: function (value) {
		// 		console.log(value)
		// 		localStorage.setItem('cart', JSON.stringify(value))
		// 	}
		// },
		mounted () {
			if (!localStorage.getItem('cart'))
				localStorage.setItem('cart', '{}')
			else
				this.$store.commit('cart', JSON.parse(localStorage.getItem('cart')))

			this.$store.watch(this.$store.getters.getCart, cart => {
				localStorage.setItem('cart', JSON.stringify(cart))
			})
		}
	}

</script>