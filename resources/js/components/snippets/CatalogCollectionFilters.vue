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
					price: [0, 999999999]
				},
				filtersLoaded: false,
				firstUpdate: true,
				priceLimits: {
					min: 0,
					max: 0
				}
			}
		},
		methods: {
			saveFilters () {
				localStorage.setItem(`filters_conf_${this.$url.path()}`, JSON.stringify(this.filters))
			},
			updateCatalog () {				
				if (this.$url.params().page > 1 & !this.firstUpdate) {
					window.location.href = this.$url.setParams({page: 1})
					return
				}

				this.$store.state.catalogWait = true
				this.$store.commit('updateProducts', {})

				this.$store.dispatch('fetchCatalog', {
					'api': this.$store.state.laradata['api.catalog'],
					'params': {
						'page': this.$url.params().page,
						'filters': this.filters,
						'attach_filter_list': this.firstUpdate
					}
				})

				this.firstUpdate = false
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
			'$store.getters.getFilters' (value) {
				if (this.filtersLoaded)
					return
				
				this.filtersLoaded = true
				this.priceLimits.min = value.price[0]
				this.priceLimits.max = value.price[1]
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
		},
		mounted () {
			const filtersJson = localStorage.getItem(`filters_conf_${this.$url.path()}`)

			if (!filtersJson) {
				this.updateCatalog()
				return
			}

			const filters = JSON.parse(filtersJson)

			this.filters.category = filters.category
			this.filters.gender = filters.gender
			this.filters.size = filters.size
			this.filters.brand = filters.brand
			this.filters.price = filters.price
		}
	}

</script>