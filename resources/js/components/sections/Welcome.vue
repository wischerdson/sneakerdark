<script type="text/javascript">
	
	export default {
		template: '#template__section_welcome',
		mounted () {
			$(this.$refs.welcomeSlider).slick({
				autoplay: true,
				autoplaySpeed: 8000,
				arrows: false,
				pauseOnDotsHover: true,
				appendDots: this.$refs.sliderDots,
				dots: true
			});
		}
	}

</script>