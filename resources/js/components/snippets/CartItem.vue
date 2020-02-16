
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
			'product-instock': {},
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
				return this.options.length ? this.options[0] : false
			},
			instock () {
				const instock = this.option ? this.option.instock : this.productInstock
				return Math.min(instock, 15)
			}
		}
	}

</script>