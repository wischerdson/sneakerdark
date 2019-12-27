<script type="text/javascript">
	
	export default {
		template: '#template__brands',
		data () {
			return {
				brands: {},
				brandList: {},
				letters: [],
				currentLetter: 'Все'
			}
		},
		methods: {
			filterByLetter (letter) {
				this.currentLetter = letter
				if (letter == 'Все') {
					this.brandList = this.brands
					return
				}
				this.brandList = {}
				this.brandList[letter] = this.brands[letter]
			}
		},
		mounted () {
			let brands = this.$store.state.laradata.brands

			Object.keys(brands).forEach(key => {
				const letter = key[0]
				this.brands[letter] = this.brands[letter] || {}
				this.brands[letter][key] = brands[key]

				if (this.letters.indexOf(letter) < 0)
					this.letters.push(letter)
			}, brands)

			this.letters.push('Все')
			this.brandList = this.brands
		}
	}

</script>