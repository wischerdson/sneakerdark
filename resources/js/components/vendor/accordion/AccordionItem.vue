<template>
	<div>
		<slot></slot>
	</div>
</template>

<script type="text/javascript">
	
	export default {
		props: {
			disable: {
				default: false,
				type: Boolean,
				require: false
			}
		}
	}

</script>

