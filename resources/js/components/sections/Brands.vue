<script type="text/javascript">
	
	export default {
		template: '#template__section_brands',
		props: ['brandsJson'],
		data () {
			return {
				brands: {},
				brandList: {},
				letters: []
			}
		},
		methods: {
			filterByLetter (letter) {
				console.log(letter)
			}
		},
		mounted () {
			let brands = JSON.parse(this.brandsJson)

			Object.keys(brands).forEach(key => {
				const letter = key[0]
				this.brands[letter] = this.brands[letter] || {}
				this.brands[letter][key] = brands[key]

				if (this.letters.indexOf(letter) < 0)
					this.letters.push(letter)
			}, brands);

			this.letters.push('Все')
			this.brandList = this.brands
		}
	}

</script>