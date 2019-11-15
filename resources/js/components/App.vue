<script type="text/javascript">
	
	import HomePage from './templates/Home'
	import SearchPage from './templates/Search'
	import ShopProductPage from './templates/shop/Product'
	import ShopProductNotFoundPage from './templates/shop/ProductNotFound'

	export default {
		template: '#template__layout',
		components: {
			HomePage,
			SearchPage,
			ShopProductPage,
			ShopProductNotFoundPage
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