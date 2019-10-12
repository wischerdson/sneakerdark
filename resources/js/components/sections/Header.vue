<script type="text/javascript">
	
	export default {
		template: '#template__section_header',
		data () {
			return {
				isMoving: false,
				sidebarIsOpen: false,
				searchResultsIsOpened: false,
				searchQuery: '',
				searchResults: [],
				ajaxStatus: { waiting: false },
				forwhom: 'Мужской'
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
		},
		mounted () {
			this.set_isMoving()
			window.addEventListener('scroll', this.set_isMoving)
			$('#sidebar_wrapper').css('height', 389.8)
		}
	}

</script>

