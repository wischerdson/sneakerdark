<template id="template__section_cart">
	<transition name="cart-fade" :duration="350">
		<section id="section_cart" v-show="$store.state.cartIsOpen" :class="{'scrolling': willScroll}">
			<div class="overlay" @click="$store.commit('cartIsOpen', false)"></div>
			<div class="box">
				<div class="top">
					<div class="title">Ваша корзина</div>
					<div class="close" @click="$store.commit('cartIsOpen', false)">@include('svg.cross')</div>
				</div>
				<div class="content">
					<div class="product-list-wrapper" ref="productListVisibleFrame">
						<ul class="product-list" ref="productList" v-if="$store.state.cart != false">
							<cart-item
								v-for="product in $store.state.cart"
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
						</ul>
						<div v-else class="cart-is-empty">Ваша корзина пуста</div>
						<div v-if="!hideScrollPermanently" :class="['scrollbar', {'hideScroll': !showScroll && !willScroll}]" ref="scrollbar">
							<div @mousedown="manuallyScrollStart" ref="scrollBarEntity" class="scrollbar-entity" :style="`
								height: ${scrollEntityHeight}px;
								transform: translateY(${scrollEntityPosition}px);
							`"></div>
						</div>
					</div>
					<div class="has-scroll"></div>
				</div>
				<div class="bottom" v-if="$store.state.cart != false">
					<div class="subtotal">
						<div>Subtotal</div>
						<div class="sum">@{{ subtotal }}</div>
					</div>
					<div class="annotation">
						Taxes and shipping calculated at checkout
					</div>
					<button class="btn primary checkout">Оформить заказ  &#8594;</button>
				</div>
			</div>
		</section>
	</transition>
</template>