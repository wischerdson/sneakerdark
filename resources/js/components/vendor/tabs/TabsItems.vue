
<template>
	<div ref="dots" class="tabs-items-container">
		<slot></slot>
	</div>
</template>

<script type="text/javascript">
	
	import TabItem from './TabItem'

	export default {
		props: ['modelValue'],
		model: {
			prop: 'modelValue',
			event: 'change'
		},
		data () {
			return {
				tabsCount: undefined
			}
		},
		computed: {
			tabs () {
				return this.$slots.default.map(function (item, index, array) {
					if (item.componentInstance)
						return item.componentInstance.$el
				}).filter(item => item !== undefined)
			}
		},
		mounted () {
			this.tabsCount = this.tabs.length
			this.$emit('change', {
				dotsContainer: this.$refs.dots,
				dotsElements: this.tabs
			})
		}
	}
// 
</script>