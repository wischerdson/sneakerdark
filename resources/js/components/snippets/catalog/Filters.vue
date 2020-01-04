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
					brand: [],
					price: [0, 999999999],
					sort: 1
				},
				firstRequest: true,
				priceLimits: {
					min: 0,
					max: 0
				}
			}
		},
		methods: {
			update () {
				this.$storage.set(sessionStorage, {
					name: `filters_conf_${this.$url.path()}`,
					value: this.appliedFilters
				})

				if (this.$url.params().page > 1 && !this.firstRequest) {
					window.location.href = this.$url.setParams({page: 1})
					return
				}

				this.$store.commit('collection_products', {})
				this.$store.dispatch('collection_fetch', {
					'api': this.$store.state.laradata['api.catalog'],
					'params': {
						'page': this.$url.params().page,
						'filters': this.appliedFilters,
						'sort': this.sort(this.appliedFilters.sort),
						'attach_filter_list': this.firstRequest
					}
				})

				this.firstRequest = false
			},
			sort (sort) {
				sort = parseInt(sort)
				let result = {}

				switch (sort) {
					case 1:
						result = {column: 'created_at', mode: 'desc'};
					break;
					case 2:
						result = {column: 'price', mode: 'asc'};
					break;
					case 3:
						result = {column: 'price', mode: 'desc'};
					break;
				}

				return result
			}
		},
		computed: {
			filters () {
				return this.$store.getters.collection_filters
			}
		},
		watch: {
			'$store.getters.collection_sort' (value) {
				this.appliedFilters.sort = value
			},
			'$store.getters.collection_priceRange' (value) {
				this.priceLimits.min = value.min
				this.priceLimits.max = value.max
			},
			appliedFilters: {
				deep: true,
				handler (value, oldValue) {
					clearTimeout(updateTimeout)
					updateTimeout = setTimeout(() => {
						this.update()
					}, 700)
				}
			}
		},
		mounted () {
			const tmp = this.appliedFilters
			this.appliedFilters = {}
			this.appliedFilters = this.$storage.extract(sessionStorage, {
				name: `filters_conf_${this.$url.path()}`,
				default: tmp
			})
			this.$store.commit('collection_sort', this.appliedFilters.sort)
		}
	}

</script>