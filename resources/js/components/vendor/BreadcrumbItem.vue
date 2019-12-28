<template>
	<li :class="['breadcrumb-item', {'active': !url}]">
		<a :href="url"><slot></slot></a>
	</li>
</template>

<script type="text/javascript">
	
	export default {
		props: ['url']
	}

</script>