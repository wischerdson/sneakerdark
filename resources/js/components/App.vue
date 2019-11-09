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
		watch: {
			'$store.state.cart': function (value) {
				localStorage.setItem('cart', JSON.stringify(value))
			}
		},
		mounted () {
			if (!localStorage.getItem('cart'))
				this.$store.commit('cart', [])
			else
				this.$store.commit('cart', JSON.parse(localStorage.getItem('cart')))
		}
	}

</script>