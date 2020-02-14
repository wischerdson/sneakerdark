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
				console.log(this.$store.getters.cart)
				return this.$store.getters.cart
			},
			itemsCount () {
				return Object.keys(this.items).length
			},
			isEmpty () {
				return this.itemsCount > 0
			}
		},
		mounted () {
			
		}
	}

</script>