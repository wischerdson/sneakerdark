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
		}
	}

</script>