<script type="text/javascript">
	
	import CartItem from '../snippets/CartItem'

	export default {
		template: '#template__section_cart',
		data () {
			return {
				scrollEntityHeight: 0,
				scrollEntityPosition: 0,
				willScroll: false,
				startMouseY: 0,
				showScroll: false,
				hideScrollPermanently: false,
				showScrollTimeout: null
			}
		},
		computed: {
			subtotal () {
				const cart = this.$store.state.cart
				if (!cart)
					return
				let result = 0
				cart.forEach((value, index) => {
					result += value.price * value.quantity
				})
				return result
			}
		},
		methods: {
			computeScrollEntityHeight () {
				const listHeight = $(this.$refs.productList).outerHeight()
				const frameHeight = $(this.$refs.productListVisibleFrame).outerHeight()
				if (listHeight <= frameHeight) {
					this.hideScrollPermanently = true
					return
				}
				this.hideScrollPermanently = false
				const scrollBarHeight = $(this.$refs.scrollbar).outerHeight()

				this.scrollEntityHeight = (frameHeight / listHeight) * scrollBarHeight
			},
			computeScrollEntityPosition () {
				if (this.willScroll)
					return
				const listHeight = $(this.$refs.productList).outerHeight()
				const frameHeight = $(this.$refs.productListVisibleFrame).outerHeight()
				const scrollBarHeight = $(this.$refs.scrollbar).outerHeight()
				const frameScrolled = $(this.$refs.productListVisibleFrame).scrollTop()
				const scrollPercent = frameScrolled / (listHeight - frameHeight)

				this.scrollEntityPosition = scrollPercent * (scrollBarHeight - this.scrollEntityHeight)
			},
			manuallyScroll (e) {
				if (!this.willScroll)
					return

				const listHeight = $(this.$refs.productList).outerHeight()
				const frameHeight = $(this.$refs.productListVisibleFrame).outerHeight()
				const scrollEntityPositionY = $(this.$refs.scrollBarEntity).offset().top
				const scrollBarHeight = $(this.$refs.scrollbar).outerHeight()
				const mouseYRelativeScrollBar = e.pageY - $(this.$refs.scrollbar).offset().top
				const mouseYRelativeScrollBarEntity = mouseYRelativeScrollBar - this.scrollEntityPosition

				this.scrollEntityPosition = Math.max(Math.min(mouseYRelativeScrollBar - this.startMouseY, scrollBarHeight - this.scrollEntityHeight), 0)

				const scrollFramePercent = this.scrollEntityPosition / (scrollBarHeight - this.scrollEntityHeight)
				const scrollFrame = scrollFramePercent * (listHeight - frameHeight)

				$(this.$refs.productListVisibleFrame).scrollTop(scrollFrame)
			},
			manuallyScrollStart (e) {
				this.willScroll = true
				this.startMouseY = e.pageY - $(this.$refs.scrollBarEntity).offset().top
				console.log(e.pageY)
			}
		},
		mounted () {
			this.computeScrollEntityHeight()

			window.addEventListener('resize', () => {
				this.computeScrollEntityHeight()
				this.computeScrollEntityPosition()
			})
			this.$refs.productListVisibleFrame.addEventListener('scroll', () => {
				clearTimeout(this.showScrollTimeout)
				this.showScroll = true;
				this.showScrollTimeout = setTimeout(() => {
					this.showScroll = false;
				}, 100)
				this.computeScrollEntityPosition()
				this.computeScrollEntityHeight()
			})
			document.addEventListener('mouseup', () => {
				this.willScroll = false
			})
			document.addEventListener('mousemove', (e) => {
				this.manuallyScroll(e)
			})
		},
		components: {
			CartItem
		}
	}

</script>