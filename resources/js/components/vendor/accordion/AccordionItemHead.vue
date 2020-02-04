<template>
	<div @click="handler"><slot></slot></div>
</template>

<script type="text/javascript">
	
	export default {
		data () {
			return {
				toggle: false
			}
		},
		methods: {
			handler () {
				this.$parent.$emit('toggle', this.toggle)
				this.toggle = !this.toggle
			}
		}
	}

</script>