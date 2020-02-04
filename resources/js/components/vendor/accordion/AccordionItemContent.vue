<template>
	<div :style="style" class="accordion-item-content">
		<div ref="origin"><slot></slot></div>
		<div ref="tempStorage" style="opacity: 0; pointer-events: none; position: absolute;"></div>
	</div>
</template>

<script type="text/javascript">
	
	export default {
		data () {
			return {
				height: 0
			}
		},
		computed: {
			style () {
				return {
					height: this.height,
					overflow: 'hidden',
					position: 'relative'
				}
			}
		},
		methods: {
			toggleHandler (value) {
				if (value) {
					this.height = 0
				} else {
					this.$refs.tempStorage.innerHTML = this.$refs.origin.innerHTML
					let h = this.$refs.tempStorage.getBoundingClientRect().height
					this.$refs.tempStorage.innerHTML = ''
					this.height = h + 'px'
				}
			}
		},
		mounted () {
			this.$parent.$on('toggle', this.toggleHandler)
		}
	}

</script>

<style type="text/css">
	
	.accordion-item-content {
		transition: height .2s ease-in-out;
	}

</style>