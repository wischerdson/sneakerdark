<script type="text/javascript">
	
	export default {
		template: '#template__catalog_collection',
		computed: {
			showCatalog () {
				return Object.keys(this.$store.getters.getCatalog).length
			},
			products () {
				return this.$store.getters.getProducts
			}
		},
		mounted () {
			const apiUrl = this.$refs.catalogUrl.textContent;
			this.$refs.catalogUrl.remove()
			
			this.$store.dispatch('fetchCatalog', apiUrl)
		}
	}

</script>