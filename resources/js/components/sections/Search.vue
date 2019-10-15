<script type="text/javascript">
	
	let searchQueryTimeout

	export default {
		template: '#template__section_search',
		props: ['url'],
		data () {
			return {
				results: [],
				query: '',
				ajaxStatus: { waiting: false },
				gender: 'Мужской',
				resultsNumber: 0,
				totalResults: ''
			}
		},
		methods: {
			search () {
				if (!this.query) return
				this.ajaxStatus.waiting = true

				const data = {
					query: this.query,
					gender: this.gender
				}
				this.$http.get(this.url, {params: data}).then(response => response.body).then(data => {
					this.ajaxStatus.waiting = false
					this.results = data.results
					this.totalResults = data.results_number + ' ' + data.subject
					this.resultsNumber = data.results_number
					console.log(data)
				}, err => {
					this.ajaxStatus.waiting = false
					console.log(err)
					M.toast({html: 'Произошла ошибка', classes: 'error-toast'})
				})
			},
			getPicture (picture, noImageUrl) {
				return picture.length ? picture[0].src : noImageUrl
			}
		},
		watch: {
			gender () {
				this.search(this.$store.state.searchQuery)
			}
		},
		computed: {
			searchQuery () {
				this.query = this.$store.state.searchQuery
				clearTimeout(searchQueryTimeout)
				searchQueryTimeout = setTimeout(() => {
					this.search()
				}, 700)
			},
			isOpen () {
				return this.$store.state.searchIsOpen
			}
		}
	}

</script>