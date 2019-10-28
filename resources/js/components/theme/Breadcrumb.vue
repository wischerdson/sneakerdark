<template>
	<nav class="breadcrumb">
		<ul class="breadcrumb-list">
			<slot></slot>
		</ul>
	</nav>
</template>

<script type="text/javascript">
	
	import BreadcrumbItem from './BreadcrumbItem'

	export default {
		components: {
			BreadcrumbItem
		}
	}

</script>