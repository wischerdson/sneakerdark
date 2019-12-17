<template id="template__snippet_catalog_collection_product">
	<li class="product-item">
		<div class="square">
			<div class="picture" :style="`background-image: url(${picture})`"></div>
		</div>
		<div class="vendor">@{{ vendor }}</div>
		<center><a class="title" :href="url0">@{{ title }}</a></center>
		<div class="price">@{{ price }}</div>
	</li>
</template>