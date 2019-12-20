<script type="text/javascript">
	
	export default {
		template: '#template__legal_refund',
		computed: {
			time () {
				console.log(this.$store.getters.laradata)
				return this.$store.getters.getCart
			}
		}
	}

</script>