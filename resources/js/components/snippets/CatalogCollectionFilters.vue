<script type="text/javascript">
	
	import noUiSlider from 'nouislider'

	let updateTimeout;

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
				filters: {
					category: [],
					gender: [],
					size: [],
					brand: [],
					price_min: null,
					price_max: null
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
			},
			updateCatalog () {
				if (this.$url.params().page > 1)
					window.location.href = this.$url.setParams({page: 1})
			}
		},
		computed: {
			getFilters () {
				const filters = this.$store.getters.getFilters
				if (!Object.keys(filters).length)
					return {}
				this.price.minLimit = filters.price_min
				this.price.maxLimit = filters.price_max
				this.initPriceRange()
				return filters
			},
			genderSection () {
				return !Object.keys(this.getFilters).length ? false : (this.getFilters.gender.length > 1 ? true : false)
			},
			sizeSection () {
				return !Object.keys(this.getFilters).length ? false : (this.getFilters.size.length > 1 ? true : false)
			},
			brandSection () {
				return !Object.keys(this.getFilters).length ? false : (this.getFilters.brand.length > 1 ? true : false)
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
			},
			filters: {
				deep: true,
				handler (value) {
					clearTimeout(updateTimeout)
					updateTimeout = setTimeout(() => {
						this.updateCatalog()
					}, 700)
				}
			}
		}
	}

</script>