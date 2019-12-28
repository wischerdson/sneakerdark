<script type="text/javascript">
	
	import SnippetCatalogCollectionProduct from '../../snippets/catalog/ProductItem'
	import SnippetCatalogCollectionFilters from '../../snippets/catalog/Filters'

	export default {
		template: '#template__catalog_collection',
		components: {
			SnippetCatalogCollectionProduct, SnippetCatalogCollectionFilters
		},
		data () {
			return {
				delayRatio: null
			}
		},
		computed: {
			showCatalog () {
				return Object.keys(this.$store.getters.getCatalog).length
			},
			products () {
				return this.$store.getters.getProducts
			},
			pagination () {
				return this.$store.getters.getPagination
			}
		}
	}

</script>