<template>
	<div class="has-scroll-component">
		<transition name="has-scroll">
			<div
			v-show="showPrepend"
			class="has-scroll-prepend"

			:style="`background: linear-gradient(to top, transparent, ${color} 100%)`
			"></div>
		</transition>
		<div :class="['has-scroll-inner', class_]" @scroll="scroll" ref="scrollOuter">
			<slot></slot>
		</div>
		<transition name="has-scroll">
			<div
			v-show="showAppend"
			class="has-scroll-append"
			:style="`background: linear-gradient(to bottom, transparent, ${color} 100%)`
			"></div>
		</transition>
	</div>
</template>

<script type="text/javascript">
	//:style="`background-image: linear-gradient(180deg,hsla(0,0%,100%,0), ${color} 25px);`"
	
	export default {
		props: ['color', 'class_'],
		data () {
			return {
				showAppend: false,
				showPrepend: false
			}
		},
		methods: {
			scroll (e) {
				const scroll = e.target.scrollTop
				const scrollTopMax = e.target.scrollHeight - e.target.clientHeight

				this.showPrepend = scroll > 0 + 4
				this.showAppend = scroll < scrollTopMax - 4
			}
		},
		mounted () {
			this.$refs.scrollOuter.addEventListener('firstInit', this.scroll)
			this.$refs.scrollOuter.dispatchEvent(new Event('firstInit'))
		}
	}

</script>