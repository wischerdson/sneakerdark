<script type="text/javascript">
	
	import CartItem from '../snippets/CartItem'

	export default {
		template: '#template__section_cart',
		watch: {
			'$store.getters.cart': {
				deep: true,
				handler (value) {
					this.$storage.set(localStorage, {
						name: 'cart',
						value
					})
				}
			},
			'$store.getters.cart_isOpen' (value) {
				value ? this.update() : null
			}
		},
		computed: {
			isOpen () {
				return this.$store.getters.cart_isOpen
			},
			subtotal () {
				return 123
			}
		},
		methods: {
			update () {
				console.log(this.$store.state.laradata['api.cart'])
				this.$store.dispatch('cart_fetchProductsDetails', {
					api: this.$store.state.laradata['api.cart'],
					params: {
						products: this.$store.getters.cart
					}
				})
			}
		},
		components: {
			CartItem
		},
		mounted () {
			this.$store.commit('cart_set', this.$storage.extract(localStorage, {
				name: 'cart',
				default: {}
			}))
		}
	}

</script>