<template>
	<li class="product-item">
		{{ name }}
		<!-- <div class="left">
			<a class="product-picture">
				<img :src="image">
			</a>
		</div>
		<div class="right">
			<a class="product-name" :href="url">{{ name }}</a>
			<div class="product-meta">{{ size }}/{{ color }}</div>
			<div class="qty-price-wrapper">
				<div class="quantity">
					<button @click="quantity--"><span>-</span></button>
					<input type="text" name="quantity" v-model="quantity">
					<button @click="quantity++"><span>+</span></button>
				</div>
				<div class="remove" @click="quantity = 0">Удалить</div>
				<div class="price">{{ price * quantity }}</div>
			</div>
		</div> -->
	</li>
</template>

<script type="text/javascript">
	
	export default {
		props: ['name', 'image', 'url', 'quantity', 'price', 'productId'],
		watch: {
			/*quantity (newQuantity, oldQuantity) {
				let cart = this.$store.getters.cart

				const currentProduct = this.id + 'O' + this.size




				if (!cart.hasOwnProperty(currentProduct))
					return

				cart[currentProduct].quantity = newQuantity
				if (newQuantity === 0)
					delete cart[currentProduct]

				this.$store.commit('cart', cart)
			}*/
		}
	}

</script>