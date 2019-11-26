<script type="text/javascript">
	export default {
		template: '#template__checkbox',
		model: {
			prop: 'modelValue'
		},
		data () {
			return {
				uuid: ''
			}
		},
		props: ['modelValue', 'value', 'name', 'disabled'],
		computed: {
			checked() {
				if (this.modelValue instanceof Array)
					return this.modelValue.includes(this.value)
				return this.modelValue === true
			}
		},
		methods: {
			handleInput(event) {
				let value = event.target.checked

				if (this.modelValue instanceof Array) {
					let newValue = [...this.modelValue]

					if (value)
						newValue.push(this.value)
					else
						newValue.splice(newValue.indexOf(this.value), 1)
					
					value = newValue
				}
				this.$emit('input', value)
			}
		},
		created () {
			this.uuid = '_' + Math.round(Math.random() * Math.pow(10, 15))
		}
	}

</script>