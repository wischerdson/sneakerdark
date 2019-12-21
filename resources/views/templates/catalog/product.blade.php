<template id="template__catalog_product">
	<div class="container" id="template_shop_product">
		<input type="hidden" name="product_id" value="{{ $product->id }}">
		<input type="hidden" name="product_link" value="{{ route('catalog.product', ['product_id' => $product->id]) }}">
		<input type="hidden" name="product_title" value="{{ $product->title }}">
		<input type="hidden" name="product_price" value="{{ $product->price }}">
		<input type="hidden" name="product_picture" value="{{ $product->pictures[0]->src }}">
		<div class="top">
			<div class="left">
				<div class="sticky">
					<div ref="presentation">
						<div class="frame">
							<button @click="galleryIsOpen = true" class="expand-btn">@include('svg.resize-expand')</button>
							<div class="arrow-nav">
								<div class="arrow" ref="sliderPrevArrow">@include('svg.keyboard-arrow-left')</div>
							</div>
							<div ref="pictures" @mousedown="enableZoom">
								@foreach ($product->pictures as $picture)
								<div class="image-wrapper">
									<div
									:class="['image', {'transition': zoomTransition}]"
									:style="`
										background-image: url({{ $picture->src }});
										top: ${zoomTop}px;
										left: ${zoomLeft}px;
										right: ${zoomRight}px;
										bottom: ${zoomBottom}px;
									`"
									></div>
								</div>
								@endforeach
							</div>
							<div class="arrow-nav">
								<div class="arrow" ref="sliderNextArrow">@include('svg.keyboard-arrow-right')</div>
							</div>
						</div>
						<div class="slider-navigation" ref="sliderNavigation">
							@foreach ($product->pictures as $picture)
							<div class="mini-image" style="background-image: url({{ $picture->src }})"></div>
							@endforeach
						</div>
					</div>
					<div>
						<breadcrumb>
							<breadcrumb-item url="{{ route('home') }}">Главная</breadcrumb-item>
							@foreach ($categoriesChain as $category)
							<breadcrumb-item url="#">{{ $category->name }}</breadcrumb-item>
							@endforeach
							<breadcrumb-item>{{ $product->title }}</breadcrumb-item>
						</breadcrumb>
					</div>
				</div>
			</div>
			<div class="right">
				<div class="vendor">{{ $product->vendor }}</div>
				<h2>{{ $product->title }}</h2>
				<div class="info">
					<div>Артикул: <span>{{ $product->id }}</span></div>
					&nbsp;&nbsp;/&nbsp;&nbsp;
					<a href="#">{{ $product->vendor }}</a>
				</div>
				<div class="price-wrapper">
					<div class="compare-at-price">{{ $product->price * 1.2 }}</div>
					<div class="price">{{ $product->price }}</div>
					<a @click="foundCheaperModalIsOpen = true" class="found-cheaper-link">Нашли дешевле?</a>
				</div>
				
				<ul class="parameter-list">
					@foreach ($product->parameters as $parameter)
						@if ($parameter->key == 'Пол')
							@continue
						@endif
						@if ($parameter->key == 'Цвет')
						<input type="hidden" name="product_color" value="{{ $parameter->value }}">
						@endif
						<li class="parameter-item">
							<span class="parameter-key">{{ $parameter->key }}</span>
							<span class="parameter-value">{{ $parameter->value }}</span>
						</li>
					@endforeach
				</ul>


				@if (isset($product->sizes[0]))
				<div class="sizes-wrapper">
					<div class="title">Размер <button class="how-to-choose-size-btn">@include('svg.ruler')Таблица размеров</button></div>
					<ul class="size-list">
						@foreach ($product->sizes as $size)
						@if ($size->instock !== 0)
						<li class="size-item" instock="{{ $size->instock }}">
							<input
							type="radio"
							name="product_size"
							id="size_{{ $size->bizoutmax_id }}"
							value="{{ $size->size }}"
							v-model="product.size"
							>
							<label for="size_{{ $size->bizoutmax_id }}">
								{{ $size->size }}
							</label>
							@if ($size->instock === 1)
							<div class="tip">Осталась 1 шт.</div>
							@endif
						</li>
						@endif
						@endforeach
					</ul>
				</div>
				@endif

				@if (isset($product->colors) && count($product->colors) > 1)
				<div class="colors-wrapper">
					<div class="title">Доступные цвета</div>
					<ul class="color-list">
						@foreach ($product->colors as $color)
						<li
							class="color-item @if ($color->id == $product->id) current @endif"
							style="background-image: url({{ $color->pictures[0]->src ?? asset('image/no-image.jpg') }})"
						>
							<a href="{{ route('catalog.product', ['product_id' => $color->id]) }}">
								@if ($color->id == $product->id)
								<div class="tick">@include('svg.tick')</div>
								@endif
							</a>
						</li>
						@endforeach
					</ul>
				</div>
				@endif

				<div class="buttons">
					<button @click="addToCart" class="btn primary add-to-cart waves-effect waves-light">
						<span>Добавить в корзину</span>
						@include('svg.shopping-bag')
					</button>
					<div class="btn primary add-to-wishlist without-active">
						<div class="tip">Добавить в избранное</div>
						@include('svg.wishlist')
					</div>
				</div>
				<div v-if="sizeIsNotSelect" class="invalid-feedback">Пожалуйста, выберите размер</div>
				<div class="note">
					<p>Бесплатная доставка Почтой России</p>
					<p>При 100% предоплате заказа от 7000 рублей</p>
				</div>
			</div>
		</div>
		<div class="bottom">
			<ul class="tab-list" ref="tabList" has-desc="{{ $product->description ? 1 : 0 }}" :style="`grid-template-columns: repeat(${Object.keys(tabs).length}, 1fr)`">
				<li
					@click="setActiveTab(tab)"
					v-for="tab in tabs"
					:class="[{'active': tab.isActive}, 'tab-item']"
				>
					@{{ tab.name }}
				</li>
			</ul>
			<div class="tab-content">
				<div class="description" v-if="tabs.description" v-show="tabs.description.isActive">
					<div class="text">{!! $product->description !!}</div>
					@php

						$a = count($product->pictures);
						$a = rand(0, $a - 1);

					@endphp
					<div class="rand-picture"><img src="{{ $product->pictures[$a]->src }}"></div>
				</div>
				<div v-show="tabs.sizes.isActive">Размеры</div>
				<div v-show="tabs.shipping.isActive">shipping</div>
				<div v-show="tabs.refund.isActive">refund</div>
				<div v-show="tabs.comments.isActive">comments</div>
				<div v-show="tabs.guarantees.isActive">guarantees</div>
			</div>
			<div class="live-chat">
				<button><span class="online-dot"></span> Online-чат с менеждером</button>
			</div>
		</div>
		@include('snippets.shop-product-gallery')
		@include('snippets.shop-product-found_cheaper_modal')
	</div>
</div>
</template>