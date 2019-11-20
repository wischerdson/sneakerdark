<script type="text/javascript">
	
	import HomePage from './templates/Home'
	import SearchPage from './templates/Search'
	import BrandsPage from './templates/Brands'

	import CatalogProductPage from './templates/catalog/Product'
	import CatalogProductNotFoundPage from './templates/catalog/ProductNotFound'
	import CatalogPage from './templates/catalog/Collection'

	import LegalRefundPage from './templates/legal/Refund'

	export default {
		template: '#template__layout',
		components: {
			HomePage,
			SearchPage,
			BrandsPage,
			CatalogPage,
			CatalogProductPage,
			CatalogProductNotFoundPage,
			LegalRefundPage
		},
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