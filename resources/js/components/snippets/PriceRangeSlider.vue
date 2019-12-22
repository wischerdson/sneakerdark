<template>
	<div class="range">
		<div ref="range"></div>

		<div class="row">
			<input
				:value="reactivePrice.min"
				type="number"
				name="price_min"
				class="form-control"
				@change="handleChange(0, $event)"
			>
			<div class="separator"></div>
			<input
				:value="reactivePrice.max"
				type="number"
				name="price_max"
				class="form-control"
				@change="handleChange(1, $event)"
			>
		</div>
	</div>
</template>

<script type="text/javascript">
	
	import noUiSlider from 'nouislider'

	export default {
		props: ['value', 'max', 'min'],
		data () {
			return {
				price: {
					min: 0,
					max: 0
				},
				reactivePrice: {
					min: 0,
					max: 0
				},
				range: {
					min: 0,
					max: 0
				},
				blockEmit: true
			}
		},
		methods: {
			handleChange (input, event) {
				let value = [null, null]
				value[input] = event.target.value
				this.$refs.range.noUiSlider.set(value)
			}
		},
		watch: {
			range: {
				deep: true,
				handler ({min, max}) {
					this.blockEmit = true
					this.$refs.range.noUiSlider.updateOptions({
						range: {min, max}
					})
					this.$refs.range.noUiSlider.set([min, max])
				}
			},
			price: {
				deep: true,
				handler ({min, max}) {
					if (this.blockEmit) {
						this.blockEmit = false
						return
					}
					
					console.log(123)
					this.$emit('input', [min, max])
				}
			},
			min (value) {
				this.range.min = value
			},
			max (value) {
				this.range.max = value
			},
		},
		mounted () {
			noUiSlider.create(this.$refs.range, {
				start: [0, 1],
				range: {
					min: 0,
					max: 1
				},
				step: 10,
				connect: true
			})

			this.$refs.range.noUiSlider.on('update', value => {
				this.reactivePrice.min = value[0]
				this.reactivePrice.max = value[1]
			})

			this.$refs.range.noUiSlider.on('set', value => {
				this.price.min = value[0]
				this.price.max = value[1]
			})
		}
	}

</script>