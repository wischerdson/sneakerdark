<script type="text/javascript">
	
	export default {
		template: '#template__layout',
		watch: {
			'$store.getters.wishlist' (value) {
				this.$storage.set(localStorage, {
					name: 'wishlist',
					value
				})
			}
		},
		mounted () {
			this.$store.dispatch('cart', {
				url: this.$store.state.laradata['api.cart.index'],
				params: {
					fields: ['name', 'vendor', 'instock']
				}
			})
			
			this.$store.commit('wishlist_set', this.$storage.extract(localStorage, {
				name: 'wishlist',
				default: []
			}))
		}
	}

</script>