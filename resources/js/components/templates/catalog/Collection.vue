<script type="text/javascript">
	
	export default {
		template: '#template__catalog_collection',
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
			}/*,
			transitionDelay () {
				if (this.delayRatio)
					return

				return `transition-delay: ${index*delayRatio}s`
			}*/
		}
	}

</script>