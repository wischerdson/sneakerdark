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
						<ul class="product-list" ref="productList">
							<li class="product-item">
								<div class="left">
									<a class="product-picture">
										<img src="http://bizoutmax.ru/image/data/products/6311/krossovki-adidas-yeezy-350-boost-v2-1.jpg">
									</a>
								</div>
								<div class="right">
									<div class="product-name">Кроссовки Adidas Yeezy 350 Boost v2</div>
									<div class="product-meta">35/Черный</div>
									<div class="qty-price-wrapper">
										<div class="quantity">
											<input type="number" name="quantity" value="1">
										</div>
										<div class="price">2600</div>
									</div>
								</div>
							</li>

							<li class="product-item">
								<div class="left">
									<a class="product-picture">
										<img src="http://bizoutmax.ru/image/data/products/6311/krossovki-adidas-yeezy-350-boost-v2-1.jpg">
									</a>
								</div>
								<div class="right">
									<div class="product-name">Кроссовки Adidas Yeezy 350 Boost v2</div>
									<div class="product-meta">35/Черный</div>
									<div class="qty-price-wrapper">
										<div class="quantity">
											<input type="number" name="quantity" value="1">
										</div>
										<div class="price">2600</div>
									</div>
								</div>
							</li>
						</ul>
						<div v-if="!hideScrollPermanently" :class="['scrollbar', {'hideScroll': !showScroll && !willScroll}]" ref="scrollbar">
							<div @mousedown="manuallyScrollStart" ref="scrollBarEntity" class="scrollbar-entity" :style="`
								height: ${scrollEntityHeight}px;
								transform: translateY(${scrollEntityPosition}px);
							`"></div>
						</div>
					</div>
					<div class="has-scroll"></div>
				</div>
				<div class="bottom">
					<div class="subtotal">
						<div>Subtotal</div>
						<div class="sum">15000</div>
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