<script type="text/javascript">
	
	import noUiSlider from 'nouislider'

	export default {
		template: '#template__snippet_catalog_collection_filters',
		props: ['categoryId'],
		data () {
			return {
				price: {
					min: 0,
					max: 12000
				},
				rangeIsActive: false
			}
		},
		watch: {
			'price.min' (value) {
				if (this.rangeIsActive)
					return
				this.$refs.range.noUiSlider.set([value, null])
			},
			'price.max' (value) {
				if (this.rangeIsActive)
					return
				this.$refs.range.noUiSlider.set([null, value])
			}
		},
		mounted () {
			noUiSlider.create(this.$refs.range, {
				start: [this.price.min, this.price.max],
				connect: true,
				range: {
					'min': this.price.min,
					'max': this.price.max
				}
			});

			this.$refs.range.noUiSlider.on('update', values => {
				this.price.min = values[0]
				this.price.max = values[1]
			})
			this.$refs.range.noUiSlider.on('start', () => {
				this.rangeIsActive = true
			})
			this.$refs.range.noUiSlider.on('end', () => {
				this.rangeIsActive = false
			})
		}
	}

</script>