<script type="text/javascript">
	
	import noUiSlider from 'nouislider'

	export default {
		template: '#template__snippet_catalog_collection_filters',
		data () {
			return {
				price: {
					minLimit: null,
					maxLimit: null,
					min: 0,
					max: 12000
				},
				rangeIsActive: false,
				rangeInitialized: false
			}
		},
		methods: {
			initPriceRange () {
				if (this.rangeInitialized)
					return
				this.rangeInitialized = true
				
				noUiSlider.create(this.$refs.range, {
					start: [this.price.minLimit, this.price.maxLimit],
					connect: true,
					range: {
						min: this.price.minLimit,
						max: this.price.maxLimit
					}
				})

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
		},
		computed: {
			filters () {
				const filters = this.$store.getters.getFilters
				if (!Object.keys(filters).length)
					return {}
				this.price.minLimit = filters.price_min
				this.price.maxLimit = filters.price_max
				this.initPriceRange()
				return filters
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
		}
	}

</script>