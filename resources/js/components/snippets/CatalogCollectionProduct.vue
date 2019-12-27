<script type="text/javascript">
	
	export default {
		template: '#template__snippet_catalog_collection_product',
		props: {
			'id': Number,
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
			}
		},
		methods: {
			addToWishlist () {
				this.$store.commit('wishlistAdd', this.id)
			},
			removeFromWishlist () {
				this.$store.commit('wishlistRemove', this.id)
			}
		},
		computed: {
			inWishlist () {
				return this.$store.getters.wishlist.indexOf(this.id) >= 0
			}
		}
	}

</script>