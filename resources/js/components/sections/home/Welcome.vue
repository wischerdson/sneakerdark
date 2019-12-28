<script type="text/javascript">
	
	export default {
		template: '#template__section_welcome',
		mounted () {
			$(this.$refs.welcomeSlider).slick({
				autoplay: true,
				autoplaySpeed: 8000,
				arrows: true,
				pauseOnDotsHover: true,
				appendDots: this.$refs.sliderDots,
				dots: true,
				prevArrow: this.$refs.sliderArrowToLeft,
				nextArrow: this.$refs.sliderArrowToRight
			});
		}
	}

</script>