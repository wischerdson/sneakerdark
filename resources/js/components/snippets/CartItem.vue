
<script type="text/javascript">
	
	export default {
		template: '#template__snippet_cart_item',
		props: {
			'name': String,
			'vendor': String,
			'image': String,
			'url': String,
			'quantity': Number,
			'price': Number,
			'productId': Number,
			'productInstock': {},
			'options': {
				type: Array,
				default () {
					return []
				}
			}
		},
		watch: {
			/*quantity (newQuantity, oldQuantity) {
				let cart = this.$store.getters.cart

				const currentProduct = this.id + 'O' + this.size




				if (!cart.hasOwnProperty(currentProduct))
					return

				cart[currentProduct].quantity = newQuantity
				if (newQuantity === 0)
					delete cart[currentProduct]

				this.$store.commit('cart', cart)
			}*/
		},
		computed: {
			option () {
				return this.options.length ? this.options[0] : {}
			},
			instock () {
				const instock = Object.keys(this.option).length ? this.option.instock : this.productInstock
				return instock ? Math.min(instock, 15) : 0
			}
		}
	}

</script>