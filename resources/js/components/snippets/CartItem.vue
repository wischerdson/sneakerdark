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
				<div class="price">{{ price * quantity }}</div>
			</div>
		</div>
	</li>
</template>

<script type="text/javascript">
	
	export default {
		props: ['title', 'color', 'size', 'picture', 'url', 'quantity', 'price', 'id'],
		watch: {
			quantity (newQuantity, oldQuantity) {
				let cart = this.$store.state.cart

				cart.forEach((value, index) => {
					if (value.id == this.id && value.size == this.size) {
						cart[index].quantity = newQuantity
						if (newQuantity === 0) {
							cart.splice(index, 1)
						}
						return
					}
				})
				this.$store.commit('cart', cart)
			}
		}
	}

</script>