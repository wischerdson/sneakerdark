<template id="template__section_cart">
	<transition name="cart-fade" :duration="350">
		<section id="section_cart" v-show="$store.state.cartIsOpen">
			<div class="overlay" @click="$store.commit('cartIsOpen', false)"></div>
			<div class="box">
				<div class="top">
					<div class="title">Ваша корзина</div>
					<div class="close" @click="$store.commit('cartIsOpen', false)">@include('svg.cross')</div>
				</div>
				<div class="content">
					<div class="product-list-wrapper" ref="productListVisibleFrame">
						<div class="product-list" ref="productList">
							<transition-group name="list-complete" tag="ul">
							<cart-item
								v-for="product in $store.getters.getCart()"
								:key="product.id + 'O' + product.size"
								:id="product.id"
								:title="product.title"
								:color="product.color"
								:size="product.size"
								:picture="product.picture"
								:url="product.link"
								:quantity="product.quantity"
								:price="product.price"
							></cart-item>
							</transition-group>
						</div>
						<transition name="fade">
							<div v-show="!Object.keys($store.getters.getCart()).length" class="cart-is-empty">Ваша корзина пуста</div>
						</transition>
					</div>
					<div class="has-scroll"></div>
				</div>
				<transition name="fade">
					<div class="bottom" v-show="Object.keys($store.getters.getCart()).length">
						<div class="subtotal">
							<div>Subtotal</div>
							<div class="sum">@{{ subtotal }}</div>
						</div>
						<div class="annotation">
							Taxes and shipping calculated at checkout
						</div>
						<button class="btn primary checkout">Оформить заказ  &#8594;</button>
					</div>
				</transition>
			</div>
		</section>
	</transition>
</template>