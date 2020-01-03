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
			/*
			'$store.getters.cart' (value) {
				localStorage.setItem('cart', JSON.stringify(value))
			}*/
		},
		mounted () {
			this.$store.commit('wishlist_set', this.$storage.extract(localStorage, {
				name: 'wishlist',
				default: []
			}))
			
			/*if (!localStorage.getItem('cart'))
				localStorage.setItem('cart', '{}')
			else
				this.$store.commit('cart', JSON.parse(localStorage.getItem('cart')))
*/
		}
	}

</script>