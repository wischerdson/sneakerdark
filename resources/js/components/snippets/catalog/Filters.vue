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
					color: [],
					season: [],
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
				let page = this.$url.hasParam('page') ? this.$url.getParam('page') : 1

				history.replaceState(this.appliedFilters, null, this.$url.setParam('f', JSON.stringify(this.appliedFilters)));

				if (page > 1 && !this.firstRequest) {
					window.location.href = this.$url.setParam('page', 1)
					return
				}

				const filtersFields = ['category', 'gender', 'season', 'color', 'brand', 'size', 'price']

				this.$store.commit('collection_products', {})
				this.$store.dispatch('collection_fetch', {
					'api': this.$store.state.laradata['api.catalog'],
					'params': {
						'page': page,
						'sort': this.sort(this.appliedFilters.sort),
						'fields': ['name', 'vendor', 'sizes'],
						'applied_filters': this.appliedFilters,
						'filters_fields': this.firstRequest ? filtersFields : []
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
				this.priceLimits.min = value.resource.min
				this.priceLimits.max = value.resource.max
			},
			appliedFilters: {
				deep: true,
				immediate: true,
				handler (value, oldValue) {
					clearTimeout(updateTimeout)
					updateTimeout = setTimeout(() => {
						this.update()
					}, 700)
				}
			}
		},
		mounted () {
			if (this.$url.hasParam('f')) {
				try {
					this.appliedFilters = JSON.parse(this.$url.getParam('f'))
					this.$store.commit('collection_sort', this.appliedFilters.sort)
				} catch (e) {
					history.replaceState(this.appliedFilters, null, this.$url.setParam('f', JSON.stringify(this.appliedFilters)));
				}
			}
		}
	}

</script>