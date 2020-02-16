<template id="template__snippet_cart_item">
	<li class="cart-item">
		<div class="product-picture">
			<a :href="url">
				<img :src="image">
			</a>
		</div>
		<div class="product-text-info">
			<div class="vendor">@{{ vendor }}</div>
			<div class="name">@{{ name }}</div>
			<div class="price">@{{ price }}</div>
			<div class="option" v-if="option">@{{ option.name }}: @{{ option.value }}</div>
			<div class="row">
				<div class="quantity">
					<div class="custom-select">
						<select>
							<option :selected="index === quantity" v-for="index in instock">@{{ index }}</option>
						</select>
						@include('svg.keyboard-arrow-down')
					</div>
					
				</div>
				<button class="btn delete">@include('svg.cross')</button>
			</div>
			
		</div>
	</li>
</template>