<script type="text/javascript">
	
	let searchQueryTimeout

	export default {
		template: '#template__section_search',
		props: ['url'],
		data () {
			return {
				searchResults: [],
				ajaxStatus: { waiting: false },
				gender: 'Мужской'
			}
		},
		methods: {
			search (query) {
				
				const data = {
					query,
					gender: this.gender
				}
				this.$http.get(this.url, {params: data}).then(response => response.body).then(data => {
					console.log(data)
				}, err => {
					M.toast({html: 'Произошла ошибка', classes: 'error-toast'})
					console.log(err)
				})
				/*if (!this.searchQuery) return;
				this.ajaxStatus.waiting = true;
				$.ajax({
					url: '{{ route('search.process_ajax_query') }}',
					type: 'POST',
					data: {
						query: this.searchQuery,
						forwhom: this.forwhom
					},
					cache: false,
					success: (data) => {
						console.log(data[0]);
						this.searchResults = data;
						this.ajaxStatus.waiting = false;
					},
					error: (error) => {
						M.toast({html: 'An error occurred', classes: 'red lighten-3 black-text'});
						console.log(error);
						this.ajaxStatus.waiting = false;
					}
				});*/
			},
			set_isOpen (value) {
				console.log(this)
				this.isOpen = value
			},
			getPicture (picture) {
				/*if (picture.length == 0) return '{{ asset('/image/no-image.jpg') }}';
				else return picture[0].src;*/
			},
		},
		watch: {
			gender () {
				this.search(this.$store.state.searchQuery)
			}
		},
		computed: {
			searchQuery () {
				let query = this.$store.state.searchQuery
				clearTimeout(searchQueryTimeout)
				searchQueryTimeout = setTimeout(() => {
					this.search(query)
				}, 700)
			},
			isOpen () {
				return this.$store.state.searchIsOpen
			}
		}
	}

</script>