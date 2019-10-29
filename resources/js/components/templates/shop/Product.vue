<script type="text/javascript">
	
	export default {
		template: '#template__shop_product',
		data () {
			return {
				zoom: false,
				zoomTop: '',
				zoomLeft: '',
				zoomRight: '',
				zoomBottom: '',
				zoomTransition: true,
				tabs: [
					{name: 'Описание', isActive: true},
					{name: 'Размеры', isActive: false},
					{name: 'Доставка', isActive: false},
					{name: 'Оплата', isActive: false}
				]
			}
		},
		methods: {
			setActiveTab (tab) {
				tab.isActive = true
				this.tabs.forEach(el => {
					el.isActive = el === tab;
				})
			},
			zoomHandler (e) {
				if (!this.zoom) return

				const zoomRatio = 2

				const frame = this.$refs.pictures

				let mouseX = e.pageX
				let mouseY = e.pageY

				const frameX = $(frame).offset().left
				const frameY = $(frame).offset().top
				const frameW = $(frame).outerWidth()
				const frameH = $(frame).outerHeight()

				let xPercentFromMouse, yPercentFromMouse

				if (mouseX < frameX) mouseX = frameX
				if (mouseX > frameX + frameW) mouseX = frameX + frameW
				if (mouseY < frameY) mouseY = frameY
				if (mouseY > frameY + frameH) mouseY = frameY + frameH

				xPercentFromMouse = (mouseX - frameX)/frameW
				yPercentFromMouse = (mouseY - frameY)/frameH

				this.zoomTop = -((frameH * zoomRatio - frameH) * yPercentFromMouse)
				this.zoomLeft = -((frameW * zoomRatio - frameW) * xPercentFromMouse)
				this.zoomBottom = -((frameH * zoomRatio - frameH) * (1 - yPercentFromMouse))
				this.zoomRight = -((frameW * zoomRatio - frameW) * (1 - xPercentFromMouse))
			},
			enableZoom (e) {
				this.zoom = true
				setTimeout(() => {
					this.zoomTransition = false
				}, 100)
				this.zoomHandler(e)
			},
			disableZoom (e) {
				this.zoom = false
				this.zoomTop = 0
				this.zoomLeft = 0
				this.zoomRight = 0
				this.zoomBottom = 0
				this.zoomTransition = true
			}
		},
		mounted () {
			const sliderNavigation = this.$refs.sliderNavigation
			this.$refs.sliderNavigation.remove()

			$(this.$refs.pictures).slick({
				prevArrow: this.$refs.sliderPrevArrow,
				nextArrow: this.$refs.sliderNextArrow,
				dots: true,
				fade: true,
				speed: 500,
				draggable: false,
				waitForAnimate: false,
				customPaging: (slider, i) => {
					return sliderNavigation.children[i].outerHTML
				},
				appendDots: this.$refs.presentation,
				dotsClass: 'slider-navigation'
			})

			document.addEventListener('mousemove', this.zoomHandler)
			document.addEventListener('mouseup', this.disableZoom)
		}
	}

</script>