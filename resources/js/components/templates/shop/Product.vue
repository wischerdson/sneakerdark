<script type="text/javascript">
	
	export default {
		template: '#template__shop_product',
		mounted () {
			const sliderNavigation = this.$refs.sliderNavigation
			this.$refs.sliderNavigation.remove()

			$(this.$refs.pictures).slick({
				prevArrow: this.$refs.sliderPrevArrow,
				nextArrow: this.$refs.sliderNextArrow,
				dots: true,
				fade: true,
				speed: 500,
				waitForAnimate: false,
				customPaging: (slider, i) => {
					return sliderNavigation.children[i].outerHTML
				},
				appendDots: this.$refs.presentation,
				dotsClass: 'slider-navigation'
			})
		}
	}

</script>