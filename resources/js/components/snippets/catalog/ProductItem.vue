<script type="text/javascript">
	
	export default {
		template: '#template__snippet_catalog_collection_product',
		props: {
			'title': String,
			'picture': String,
			'vendor': String,
			'url': String,
			'price': Number,
			'sizes': {
				type: Array,
				default () {
					return []
				}
			},
			'productId': Number
		},
		methods: {
			addToWishlist () {
				this.$store.commit('wishlist_add', this.productId)
			},
			removeFromWishlist () {
				this.$store.commit('wishlist_remove', this.productId)
			}
		},
		computed: {
			inWishlist () {
				return this.$store.getters.wishlist.indexOf(this.productId) >= 0
			}
		}
	}

</script>