<template id="template__section_cart">
	<transition name="cart-fade" :duration="350">
		<section id="section_cart" v-show="isOpen">
			<div class="overlay" @click="close"></div>
			<div class="box">
				<div class="top">
					<div class="title">Корзина (@{{ itemsCount }})</div>
					<div class="close" @click="close">@include('svg.cross')</div>
				</div>
		
				<div class="middle">
					<div class="product-list">
						<transition-group name="list-complete" tag="ul">
						<cart-item
							v-for="item in items"
							:key="`cart_item_${item.id}`"
							:productId="item.product.id"
							:vendor="item.product.vendor"
							:name="item.product.name"
							:image="item.product.image"
							:url="item.product.url"
							:quantity="item.quantity"
							:price="item.product.price"
							:product-instock="item.product.instock"
							:options="item.option"
						></cart-item>
						
						</transition-group>
						<cart-item v-show="false"></cart-item>
					</div>
					<transition name="fade">
						<div v-if="!wait" v-show="isEmpty" class="cart-is-empty">Ваша корзина пуста</div>
					</transition>
				</div>

				
					
					<!-- <div class="product-list-wrapper" ref="productListVisibleFrame">
						<div class="product-list" ref="productList">
							<transition-group name="list-complete" tag="ul">
							<cart-item
								v-for="product in $store.getters.cart"
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
						
					</div>
					<div class="has-scroll"></div> -->

				<transition name="fade">
					<div class="bottom" v-show="!isEmpty && !wait">
						<div class="subtotal">
							<div>Сумма заказа</div>
							<div class="sum">@{{ total }}</div>
						</div>
						<div class="buttons">
							<button class="btn primary checkout">Оформить заказ</button>
							<button class="btn primary close" @click="close">Продолжить покупки</button>
						</div>
					</div>
				</transition>
			</div>
		</section>
	</transition>
</template>

@include('snippets.cart-item')