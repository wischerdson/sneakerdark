<template id="template__snippet_catalog_collection_product">
	<li class="product-item">
		<a :href="url">
			<div class="picture-wrapper" :class="{'no-sizes': sizes.length === 0}">
				<ul class="sizes-panel missing" @click.prevent="" v-show="sizes.length">
					<li
						class="size-item"
						v-for="(size, index) in sizes"
						:key="`size_item_${index}`"
						v-if="size.instock"
					>
						<button class="size btn">@{{ size.size }}</button>
					</li>
				</ul>
				<button v-show="!inWishlist" class="add-to-wishlist-btn btn" @click.prevent="addToWishlist">
					<div class="tooltip">Добавить в избранное</div>
					@include('svg.wishlist')
				</button>
				<button v-show="inWishlist" class="remove-from-wishlist-btn btn" @click.prevent="removeFromWishlist">
					@include('svg.wishlist_filled')
				</button>
				<div class="square">
					<div class="picture" :style="`background-image: url(${picture})`"></div>
				</div>
			</div>
			
			<div class="text">
				<div class="vendor">@{{ vendor }}</div>
				<div class="title">@{{ title }}</div>
				<div class="price-wrapper">
					<div class="compare-at-price">@{{ price*1.2 }}</div>
					<div class="price">@{{ price }}</div>
				</div>
			</div>
		</a>
	</li>
</template>