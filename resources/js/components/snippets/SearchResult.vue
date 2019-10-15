<template>
	<li class="product">
		<div class="image square">
			<div :style="`background-image: url(${ image })`"></div>
		</div>
		<div class="details">
			<div class="name">{{ name }}</div>
			<div class="other">
				<div class="text">
					<div class="article">Артикул: {{ article }}</div>
					<div class="price">{{ price }} руб</div>
				</div>
				<ul class="sizes">
					<li
						class="size-item"
						:instock="value.instock"
						v-for="(value, index) in sizes"
					>{{ value.size }}</li>
				</ul>
			</div>
		</div>
	</li>
</template>


<script type="text/javascript">
	
	export default {
		props: ['name', 'article', 'price', 'image', 'sizes']
	}

</script>