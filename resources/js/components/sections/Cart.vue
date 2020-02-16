<script type="text/javascript">
	
	import CartItem from '../snippets/CartItem'

	export default {
		template: '#template__section_cart',
		components: {
			CartItem
		},
		methods: {
			close () {
				this.$store.commit('cart_close')
			}
		},
		watch: {
			
		},
		computed: {
			isOpen () {
				return this.$store.getters.cart_isOpen
			},
			items () {
				return this.$store.getters.cart
			},
			itemsCount () {
				return Object.keys(this.items).length
			},
			wait () {
				return this.$store.getters.cart_wait
			},
			isEmpty () {
				return this.itemsCount <= 0
			},
			total () {
				return this.isEmpty ? 0 : this.items.reduce(function(total, item) {
					return item.product.price + total
				}, 0)
			}
		},
		mounted () {
			
		}
	}

</script>