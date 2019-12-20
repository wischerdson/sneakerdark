<template>
	<div class="laradata"></div>
</template>

<script>

	export default {
		props: ['name'],
		created () {
			let value = this.$slots.default[0].text

			this.$store.commit('addLaradata', {
				key: this.name,
				value
			})
		}
	}

</script>