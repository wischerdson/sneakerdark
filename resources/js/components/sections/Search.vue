<script type="text/javascript">
		
	import SearchResult from '../snippets/SearchResult'

	let timeout

	export default {
		template: '#template__section_search',
		components: {
			'snippet-search-result': SearchResult
		},
		data () {
			return {
				search: {
					q: '',
					gender: 'all',
					fields: ['name']
				},
				w: false
			}
		},
		methods: {
			update () {
				if (!this.search.q)
					return

				this.w = false

				this.$store.dispatch('search', {
					url: this.$store.state.laradata['api.search'],
					params: this.search
				})
			},
			getPicture (picture, noImageUrl) {
				return picture || noImageUrl
			}
		},
		watch: {
			search: {
				deep: true,
				handler (value) {
					this.$store.commit('search', value)
				}
			},
			'$store.getters.search': {
				deep: true,
				handler (value) {
					this.w = true
					this.search = value
					clearTimeout(timeout)
					timeout = setTimeout(() => {
						this.update()
					}, 700)
				}
			}
		},
		computed: {
			open () {
				return this.$store.getters.search_isOpen
			},
			wait () {
				return this.$store.getters.search_isWait
			},
			results () {
				return this.$store.getters.search_results
			},
			total () {
				return this.$store.getters.search_total
			},
			totalSubject () {
				return this.$store.getters.search_totalSubject
			}
		}
	}

</script>