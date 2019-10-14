<template id="search_result_template">
	<li class="product">
		<div class="image">
			<div class="content"
			:style="`background-image: url(${ image })`"
			></div>
		</div>
		<div class="text">
			<div class="name grey-text text-darken-2">@{{ name }}</div>
			<div class="article grey-text">Артикул: @{{ article }}</div>
			<div class="price">@{{ price }} руб</div>
		</div>
		<ul class="sizes">
			<li :instock="value.instock" v-for="(value, index) in sizes">@{{ value.size }}</li>
		</ul>
	</li>
</template>


<script type="text/javascript">
	
	export default {
		props: ['name', 'article', 'price', 'image', 'sizes']
	}

</script>