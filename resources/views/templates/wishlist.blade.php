<template id="template__wishlist">
	<div class="container large" id="template_wishlist">
		<breadcrumb>
			<breadcrumb-item url="{{ route('home') }}">Главная</breadcrumb-item>
			<breadcrumb-item>Избранное</breadcrumb-item>
		</breadcrumb>
		<h1>Избранное</h1>
		<div class="product-list">
			<li class="product-item">
				<a href="#">
					<div class="picture-wrapper">
						<button v-show="!inWishlist" class="add-to-wishlist-btn btn" @click.prevent="">
							<div class="tooltip">Удалить</div>
							@include('svg.cross')
						</button>
						<button v-show="inWishlist" class="remove-from-wishlist-btn btn" @click.prevent="">
							@include('svg.wishlist_filled')
						</button>
						<div class="square">
							<div class="picture" :style="`background-image: url(https://bizoutmax.ru/image/data/products/18048/naushniki-jbl-1.jpg)`"></div>
						</div>
					</div>
					
					<div class="text">
						<div class="vendor">JBL</div>
						<div class="title">Наушники JBL</div>
						<div class="price-wrapper">
							<div class="compare-at-price">1882</div>
							<div class="price">1782</div>
						</div>
					</div>
				</a>
			</li>
		</div>
	</div>
</template>