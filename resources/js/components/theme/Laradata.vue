<template>
	<div class="laradata"></div>
</template>

<script>

	export default {
		props: ['name', 'json'],
		created () {
			let value = this.$slots.default[0].text

			if (this.json !== undefined)
				value = JSON.parse(value)

			this.$store.commit('addLaradata', {
				key: this.name,
				value
			})
		},
		mounted () {
			this.$el.remove()
		}
	}

</script>