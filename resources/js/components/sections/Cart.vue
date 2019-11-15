<script type="text/javascript">
	
	import CartItem from '../snippets/CartItem'

	export default {
		template: '#template__section_cart',
		computed: {
			subtotal () {
				const cart = this.$store.state.cart
				if (!cart)
					return
				let result = 0

				for (let key in cart) {
					const product = cart[key]
					result += product.price * product.quantity
				}

				return result
			}
		},
		components: {
			CartItem
		}
	}

</script>