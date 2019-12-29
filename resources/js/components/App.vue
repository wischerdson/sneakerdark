<script type="text/javascript">
	
	export default {
		template: '#template__layout',
		watch: {
			'$store.getters.wishlist' (value) {
				localStorage.setItem('wishlist', JSON.stringify(value))
			},
			'$store.getters.cart' (value) {
				localStorage.setItem('cart', JSON.stringify(value))
			}
		},
		mounted () {
			if (!localStorage.getItem('cart'))
				localStorage.setItem('cart', '{}')
			else
				this.$store.commit('cart', JSON.parse(localStorage.getItem('cart')))

			if (!localStorage.getItem('wishlist'))
				localStorage.setItem('wishlist', '[]')
			else
				this.$store.commit('wishlistSet', JSON.parse(localStorage.getItem('wishlist')))
		}
	}

</script>