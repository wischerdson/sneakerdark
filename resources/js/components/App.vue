<script type="text/javascript">
	
	import HomePage from './templates/Home'
	import SearchPage from './templates/Search'
	import BrandsPage from './templates/Brands'

	import CatalogProductPage from './templates/catalog/Product'
	import CatalogProductNotFoundPage from './templates/catalog/ProductNotFound'
	import CatalogCollectionPage from './templates/catalog/Collection'

	import LegalRefundPage from './templates/legal/Refund'

	export default {
		template: '#template__layout',
		components: {
			HomePage,
			SearchPage,
			BrandsPage,
			CatalogCollectionPage,
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

			/*window.jivo_onLoadCallback = () => {
				$('.copy_2W').remove()
			}
			window.jivo_onOpen = () => {
				$('.chatCopyright_3s').remove()
			}*/
		}
	}

</script>