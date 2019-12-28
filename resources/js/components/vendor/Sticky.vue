<template>
	<div :style="css">
		<slot></slot>
	</div>
</template>

<script type="text/javascript">
	
	export default {
		props: ['marginTop'],
		data () {
			return {
				oldPagePosition: 0,
				currentPagePosition: 0,
				startPosition: 0,
				scrolledUp: false,
				height: 0,
				positionRelativeWindow: 0,
				position: 0,
				css: {
					top: 0,
					position: 'relative'
				}
			}
		},
		methods: {
			scrollUp () {
				if (this.position >= this.currentPagePosition + this.marginTop) {
					this.css.top = this.marginTop + 'px'
					this.css.position = 'sticky'
				}

				if (this.scrolledUp)
					return

				if (this.positionRelativeWindow + this.getHeight() >= 0) 
					this.setPosition(this.position - this.startPosition)
				else if (this.positionRelativeWindow <= 0) {
					const parentHeight = this.$el.parentNode.getBoundingClientRect().height
					this.setPosition(Math.min(this.currentPagePosition - this.startPosition - this.getHeight(), parentHeight - this.getHeight()))
				}
				this.scrolledUp = true
			},
			scrollDown () {
				if (!this.scrolledUp)
					return

				this.setPosition($(this.$el).offset().top - this.startPosition)
				this.scrolledUp = false
			},
			updateStickyProps () {
				const boundingClientRectEl = this.$el.getBoundingClientRect()
				this.positionRelativeWindow = Math.round((boundingClientRectEl.y - this.marginTop) * 1e2)/1e2
				this.position = Math.round((window.pageYOffset + boundingClientRectEl.y) * 1e2)/1e2
			},
			setPosition (y) {
				this.css.top = y + 'px'
				this.css.position = 'relative'
			},
			getHeight () {
				const boundingClientRectEl = this.$el.getBoundingClientRect()
				return Math.round(boundingClientRectEl.height * 1e2)/1e2
			}
		},
		mounted () {
			this.startPosition = $(this.$el).offset().top
			this.updateStickyProps()

			document.addEventListener('scroll', () => {
				const currentPagePosition = window.pageYOffset
				const oldPagePosition = this.oldPagePosition

				this.updateStickyProps()

				this.currentPagePosition = currentPagePosition
				currentPagePosition < oldPagePosition ? this.scrollUp() : this.scrollDown()
				this.oldPagePosition = currentPagePosition
			})
		}
	}

</script>