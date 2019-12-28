<script type="text/javascript">
	export default {
		template: '#template__radio',
		model: {
			prop: 'modelValue',
			event: 'change'
		},
		data () {
			return {
				uuid: ''
			}
		},
		props: ['modelValue', 'value', 'name', 'disabled'],
		computed: {
			checked () {
				return this.modelValue == this.value
			}
		},
		methods: {
			handler (event) {
				this.$emit('change', this.value)
			}
		},
		created () {
			this.uuid = '_' + Math.round(Math.random() * Math.pow(10, 15))
		}
	}

</script>