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
				delayRatio: null,
				sort: 1
			}
		},
		watch: {
			sort (value) {
				this.$store.commit('collection_sort', value)
			},
			'$store.getters.collection_sort' (value) {
				this.sort = value
			}
		},
		computed: {
			showCatalog () {
				return true
			},
			products () {
				return this.$store.getters.collection_products
			},
			productsNotFound () {
				return Object.keys(this.products).length < 1 && !this.wait
			},
			pagination () {
				return this.$store.getters.collection_pagination
			},
			wait () {
				return this.$store.getters.collection_wait
			},
			firstLoad () {
				return this.$store.getters.collection_firstLoad
			},
			total () {
				return this.$store.getters.collection_total
			},
			totalSubject () {
				return this.$store.getters.collection_totalSubject
			}
		}
	}

</script>