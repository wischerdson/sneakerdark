<script type="text/javascript">
	
	export default {
		template: '#template__catalog_collection',
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
		},
		mounted () {
			this.$store.dispatch('fetchCatalog', {
				'api': this.$store.state.laradata['api.catalog'],
				'page': this.$url.params().page
			})
		}
	}

</script>