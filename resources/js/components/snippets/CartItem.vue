<template>
	<li class="product-item">
		<div class="left">
			<a class="product-picture">
				<img :src="picture">
			</a>
		</div>
		<div class="right">
			<a class="product-name" :href="url">{{ title }}</a>
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
		</div>
	</li>
</template>

<script type="text/javascript">
	
	export default {
		props: ['title', 'color', 'size', 'picture', 'url', 'quantity', 'price', 'id'],
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