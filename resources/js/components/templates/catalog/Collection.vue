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
			const apiUrl = this.$refs.catalogUrl.textContent
			this.$refs.catalogUrl.remove()
			
			this.$store.dispatch('fetchCatalog', {
				'api': apiUrl,
				'page': this.$url.params().page
			})
		}
	}

</script>