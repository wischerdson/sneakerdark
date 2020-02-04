<template>
	<div><slot></slot></div>
</template>

<script type="text/javascript">
	
	export default {
		props: {
			multiple: {
				type: Boolean,
				default: false,
				required: false
			}
		},
		methods: {
			toggleHandler (value) {
				
			}
		},
		mounted () {
			this.$on('toggle', this.toggleHandler)
		}
	}

</script>