<script type="text/javascript">
	
	import Search from './Search'

	export default {
		template: '#template__section_header',
		data () {
			return {
				isMoving: false,
				sidebarIsOpen: false
			}
		},
		methods: {
			set_isMoving () {
				this.isMoving = this.getWindowScroll() >= 75.5 ? true : false;
			},
			getWindowScroll () {
				return window.pageYOffset ? window.pageYOffset : (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop)
			},
			changeList (list, outgoingList, whereToGo) {
				$(this.$refs['wrapper']).css('height', this.$refs[list].offsetHeight);
				$(this.$refs[list]).removeClass('hidden-left').removeClass('hidden-right');
				$(this.$refs[outgoingList]).addClass(whereToGo);
			},
			openSearch () {
				this.$store.commit('searchIsOpen', true)
				this.sidebarIsOpen = false
				setTimeout(() => {
					document.getElementById('searchField').focus()
				}, 5)
			}
		},
		watch: {
			"this.$store.state.searchQuery" (value) {
				console.log(value)
			}
		},
		mounted () {
			this.set_isMoving()
			window.addEventListener('scroll', this.set_isMoving)
			$('#sidebar_wrapper').css('height', 389.8)
		}
	}

</script>

