<template>
	<div ref="tabsContent" style="margin-top: 50px" class="tabs-content-container">
		<slot></slot>
	</div>
</template>

<script type="text/javascript">

	export default {

		props: ['modelValue'],
		model: {
			prop: 'modelValue',
			event: 'change'
		},
		watch: {
			modelValue (value) {
				$(this.$refs.tabsContent).slick('slickSetOption', {
					customPaging (slider, i) {
						return value.dotsElements[i]
					},
					appendDots: value.dotsContainer
				}, true)
			}
		},
		mounted () {
			$(this.$refs.tabsContent).slick({
				adaptiveHeight: true,
				arrows: false,
				draggable: false,
				infinite: false,
				dots: true,
				fade: true,
				speed: 200,
				waitForAnimate: false
			});
		}
	}

</script>