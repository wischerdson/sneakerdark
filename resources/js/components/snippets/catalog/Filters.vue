<script type="text/javascript">

	import PriceRangeSlider from '../../snippets/catalog/PriceRangeSlider'

	let updateTimeout;

	export default {
		template: '#template__snippet_catalog_collection_filters',
		components: {
			PriceRangeSlider
		},
		data () {
			return {
				appliedFilters: {
					category: [],
					gender: [],
					size: [],
					brand: []
				},
				firstRequest: true
				/*filters: {
					category: [],
					gender: [],
					size: [],
					brand: [],
					price: [0, 999999999]
				},
				sort: {},
				filtersLoaded: false,
				firstUpdate: true,
				priceLimits: {
					min: 0,
					max: 0
				}*/
			}
		},
		methods: {
			update () {
				this.$store.commit('collection_products', {})
				this.$store.dispatch('collection_fetch', {
					'api': this.$store.state.laradata['api.catalog'],
					'params': {
						'page': this.$url.params().page,
						'filters': this.appliedFilters,
						'sort': this.sort,
						'attach_filter_list': this.firstRequest
					}
				})

				this.firstRequest = false
			}
			/*saveFilters () {
				let save = this.filters
				save.sort = parseInt(this.$store.state.sort)
				localStorage.setItem(`filters_conf_${this.$url.path()}`, JSON.stringify(save))
			},
			updateCatalog () {
				this.saveFilters()

				if (this.$url.params().page > 1 & !this.firstUpdate) {
					window.location.href = this.$url.setParams({page: 1})
					return
				}

				this.$store.commit('collection_products', {})

				this.$store.dispatch('collection_fetch', {
					'api': this.$store.state.laradata['api.catalog'],
					'params': {
						'page': this.$url.params().page,
						'filters': this.filters,
						'sort': this.sort,
						'attach_filter_list': this.firstUpdate
					}
				})

				this.firstUpdate = false
			}*/
		},
		computed: {

			filters () {
				return this.$store.getters.collection_filters
			},

			/*getFilters () {
				const filters = this.$store.getters.collection_filters
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
			}*/

		},
		watch: {
			/*'$store.getters.collection_filters' (value) {
				if (this.filtersLoaded)
					return
				
				this.filtersLoaded = true
				this.priceLimits.min = value.price[0]
				this.priceLimits.max = value.price[1]
			},
			'$store.state.sort' (value) {
				let sort = {}
				value = parseInt(value)
				switch (value) {
					case 1:
						sort = {column: 'created_at', mode: 'desc'};
					break;
					case 2:
						sort = {column: 'price', mode: 'asc'};
					break;
					case 3:
						sort = {column: 'price', mode: 'desc'};
					break;
				}

				this.sort = sort
				//this.updateCatalog()
			},
			*/
			'$store.state.localstorage.appliedFilters': {
				deep: true,
				handler (value, oldValue) {
					console.log(value)
					//this.appliedFilters = value
				}
			},
			'appliedFilters': {
				deep: true,
				handler (value, oldValue) {
					clearTimeout(updateTimeout)
					updateTimeout = setTimeout(() => {
						this.update()
						this.$store.commit('localstorage_set', {
							localStorage,
							name: `filters_conf_${this.$url.path()}`,
							alias: 'appliedFilters',
							value: this.appliedFilters
						})
					}, 700)
				}
			}
		},
		mounted () {
			this.$store.commit('localstorage_extract', {
				localStorage,
				name: `filters_conf_${this.$url.path()}`,
				alias: 'appliedFilters',
				default: this.appliedFilters
			})

			this.appliedFilters = this.$store.getters.localstorage.appliedFilters

			/*const filtersJson = localStorage.getItem(`filters_conf_${this.$url.path()}`)

			if (!filtersJson) {
				this.$store.state.sort = 1
				this.updateCatalog()
				return
			}

			const filters = JSON.parse(filtersJson)

			this.filters.category = filters.category
			this.filters.gender = filters.gender
			this.filters.size = filters.size
			this.filters.brand = filters.brand
			this.filters.price = filters.price
			this.$store.state.sort = parseInt(filters.sort)*/
		}
	}

</script>