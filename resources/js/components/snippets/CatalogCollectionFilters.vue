<script type="text/javascript">
	
	import noUiSlider from 'nouislider'

	export default {
		template: '#template__snippet_catalog_collection_filters',
		props: ['categoryId'],
		mounted () {
			noUiSlider.create(this.$refs.range, {
				start: [0, 12000],
				connect: true,
				margin: 400,
				range: {
					'min': 0,
					'max': 12000
				}
			});
		}
	}

</script>