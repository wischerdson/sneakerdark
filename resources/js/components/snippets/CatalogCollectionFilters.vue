<script type="text/javascript">
	
	
	import PriceRangeSlider from '../snippets/PriceRangeSlider'

	let updateTimeout;

	export default {
		template: '#template__snippet_catalog_collection_filters',
		components: {
			PriceRangeSlider
		},
		data () {
			return {
				filters: {
					category: [],
					gender: [],
					size: [],
					brand: [],
					price: [0, 99999999]
				},
				filtersLoaded: false,
				priceMinLimit: 0,
				priceMaxLimit: 0
			}
		},
		methods: {
			saveFilters () {

			},
			updateCatalog () {
				if (this.$url.params().page > 1)
					window.location.href = this.$url.setParams({page: 1})

				this.$store.state.catalogWait = true

				this.$store.dispatch('fetchCatalog', {
					'api': this.$store.state.laradata['api.catalog'],
					'page': this.$url.params().page,
					'filters': this.filters
				})
			}
		},
		computed: {
			getFilters () {
				const filters = this.$store.getters.getFilters
				if (!Object.keys(filters).length)
					return {}

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
			'$store.getters.getFilters' ({price_max, price_min}) {
				if (this.filtersLoaded)
					return
				
				this.filtersLoaded = true

				this.priceMinLimit = price_min
				this.priceMaxLimit = price_max
			},
			filters: {
				deep: true,
				handler (value) {
					clearTimeout(updateTimeout)
					updateTimeout = setTimeout(() => {
						this.saveFilters()
						this.updateCatalog()
					}, 700)
				}
			}
		}
	}

</script>