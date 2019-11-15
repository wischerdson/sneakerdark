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
				product: {
					size: null,
					color: null
				},
				sizeIsNotSelect: false,
				tabs: {
					description: {name: 'Описание', isActive: true},
					sizes: {name: 'Размеры', isActive: false},
					comments: {name: 'Отзывы', isActive: false},
					shipping: {name: 'Оплата и доставка', isActive: false},
					refund: {name: 'Обмен и возврат', isActive: false},
					guarantees: {name: 'Гарантии', isActive: false}
				},
				presentationSlide: 0,
				gallerySlide: 0,
				galleryIsOpen: false,
				foundCheaperModalIsOpen: false
			}
		},
		watch: {
			galleryIsOpen (value) {
				if (!value) {
					$(this.$refs.pictures).slick('slickGoTo', this.gallerySlide)
					return
				}
				$(this.$refs.gallery).slick('slickGoTo', this.presentationSlide)
			}
		},
		methods: {
			setActiveTab (tab) {
				for (let key in this.tabs) {
					this.tabs[key].isActive = this.tabs[key] === tab
				}
			},
			zoomHandler (e) {
				if (!this.zoom)
					return

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
			},
			addToCart () {
				this.sizeIsNotSelect = document.querySelector('input[name="product_size"]') && !this.product.size
				if (this.sizeIsNotSelect)
					return

				let productId = document.querySelector('input[name="product_id"]').value

				const currentProduct = {
					id: productId,
					title: document.querySelector('input[name="product_title"]').value,
					picture: document.querySelector('input[name="product_picture"]').value,
					price: document.querySelector('input[name="product_price"]').value,
					link: document.querySelector('input[name="product_link"]').value,
					size: this.product.size,
					quantity: 1
				}
				
				const colorEl = document.querySelector('input[name="product_color"]')
				if (colorEl)
					currentProduct.color = colorEl.value

				let cart = this.$store.getters.getCart()
				productId += 'O' + this.product.size
				if (cart.hasOwnProperty(productId))
					cart[productId].quantity++
				else
					cart[productId] = currentProduct

				console.log(this.product.size)
				console.log(this.product)
				console.log(currentProduct)


				this.$store.commit('cart', cart)
				this.$store.commit('cartIsOpen', true)
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
			$(this.$refs.pictures).on('afterChange', (event, slick, direction) => {
				this.presentationSlide = slick.currentSlide
			})

			document.addEventListener('mousemove', this.zoomHandler)
			document.addEventListener('mouseup', this.disableZoom)

			const hasDesc = eval(this.$refs.tabList.getAttribute('has-desc'))

			if (!hasDesc) {
				this.tabs.description = {}
				this.tabs.sizes.isActive = true
			}


			$(this.$refs.gallery).slick({
				dots: true,
				speed: 450,
				waitForAnimate: false,
				prevArrow: this.$refs.galleryPrevSlideArrow,
				nextArrow: this.$refs.galleryNextSlideArrow,
				infinite: false,
				appendDots: this.$refs.galleryNavigation
			})
			$(this.$refs.gallery).on('afterChange', (event, slick, direction) => {
				this.gallerySlide = slick.currentSlide
			})

		}
	}

</script>