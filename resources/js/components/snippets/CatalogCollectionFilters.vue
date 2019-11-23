<script type="text/javascript">
	
	export default {
		template: '#template__snippet_catalog_collection_filters',
		data () {
			return {
				oldPagePosition: 0,
				currentPagePosition: 0,
				sticky: false,
				startPosition: 0,
				scrolledUp: false,
				height: 0,
				positionRelativeWindow: 0,
				position: 0,
				marginTop: 20
			}
		},
		methods: {
			scrollUp () {
				if (this.position >= this.currentPagePosition + 50 + this.marginTop)
					this.sticky = true

				if (this.scrolledUp)
					return

				if (this.positionRelativeWindow + this.height >= 0) 
					this.setPosition(this.position - this.startPosition)
				else if (this.positionRelativeWindow <= 0) {
					const parentHeight = this.$refs.filters.parentNode.getBoundingClientRect().height
					this.setPosition(Math.min(this.currentPagePosition - this.startPosition - this.height, parentHeight - this.height))
				}
				this.scrolledUp = true
			},
			scrollDown () {
				if (!this.scrolledUp)
					return

				this.setPosition($(this.$refs.filters).offset().top - this.startPosition)
				this.sticky = false
				this.scrolledUp = false
			},
			updateFiltersProps () {
				const filters = this.$refs.filters
				this.height = Math.round(filters.getBoundingClientRect().height * 1e2)/1e2
				this.positionRelativeWindow = Math.round((filters.getBoundingClientRect().y - 50 - this.marginTop) * 1e2)/1e2
				this.position = Math.round((window.pageYOffset + filters.getBoundingClientRect().y) * 1e2)/1e2
			},
			setPosition (y) {
				this.$refs.filters.style.top = y + 'px'
			}
		},
		mounted () {
			this.startPosition = $(this.$refs.filters).offset().top
			this.updateFiltersProps()

			document.addEventListener('scroll', () => {
				const currentPagePosition = window.pageYOffset
				const oldPagePosition = this.oldPagePosition

				this.updateFiltersProps()

				this.currentPagePosition = currentPagePosition
				currentPagePosition < oldPagePosition ? this.scrollUp() : this.scrollDown()
				this.oldPagePosition = currentPagePosition
			})
		}
	}

</script>