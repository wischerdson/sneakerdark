<template id="template__catalog_product">
	<div class="container" id="template_catalog_product">
		<laradata name="productId">{{ $product->id }}</laradata>
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
								@foreach ($product->images as $picture)
								<div class="image-wrapper">
									<div
									:class="['image', {'transition': zoomTransition}]"
									:style="`
										background-image: url({{ asset($picture->src) }});
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
							@foreach ($product->images as $picture)
							<div class="mini-image" style="background-image: url({{ asset($picture->src) }})"></div>
							@endforeach
						</div>
					</div>
					<div>
						<breadcrumb>
							<breadcrumb-item url="{{ route('home') }}">Главная</breadcrumb-item>
							@foreach ($collectionsChain as $collection)
							<breadcrumb-item url="#">{{ $collection->title }}</breadcrumb-item>
							@endforeach
							<breadcrumb-item>{{ $product->title }}</breadcrumb-item>
						</breadcrumb>
					</div>
				</div>
			</div>
			<div class="right">
				<div class="vendor">{{ $product->description->vendor }}</div>
				<h2>{{ $product->description->name }}</h2>
				<div class="info">
					<div>Артикул: <span>{{ $product->sku }}</span></div>
					&nbsp;&nbsp;/&nbsp;&nbsp;
					<a href="#">{{ $product->description->vendor }}</a>
				</div>
				<div class="price-wrapper">
					<div class="compare-at-price">{{ $product->price * 1.2 }}</div>
					<div class="price">{{ $product->price }}</div>
					<a @click="foundCheaperModalIsOpen = true" class="found-cheaper-link">Нашли дешевле?</a>
				</div>
				
				<ul class="parameter-list">
					@foreach ($product->attributes as $attribute)
						@php
							$attributeName = $attribute->attribute->description->name
						@endphp
						@if ($attributeName == 'Пол')
							@continue
						@endif
						@if ($attributeName == 'Цвет')
						<input type="hidden" name="product_color" value="{{ $attribute->text }}">
						@endif
						<li class="parameter-item">
							<span class="parameter-key">{{ $attributeName }}</span>
							<span class="parameter-value">{{ $attribute->text }}</span>
						</li>
					@endforeach
				</ul>

				@if ($product->options->count())
					@foreach ($product->options as $option)
					<div class="sizes-wrapper">
						<div class="title">{{ $option->name }} <button class="how-to-choose-size-btn">@include('svg.ruler')Таблица размеров</button></div>
						<ul class="size-list">
							@foreach ($option->values as $value)

							<li class="size-item" instock="{{ $value->instock }}">
								<input
									type="radio"
									name="product_size"
									id="size_{{ $value->id }}"
									value="{{ $value->id }}"
									v-model="product.size"
								>
								<label for="size_{{ $value->id }}">
									{{ $value->value }}
								</label>
								@if ($value->instock === 1)
								<div class="tip">Осталась 1 шт.</div>
								@endif
							</li>

							@endforeach
						</ul>
					</div>
					@endforeach
				@endif

				@if ($product->colors->count() > 1)
				<div class="colors-wrapper">
					<div class="title">Доступные цвета</div>
					<ul class="color-list">
						@foreach ($product->colors as $color)
						<li
							class="color-item @if ($color->id == $product->id) current @endif"
							style="background-image: url({{ asset($color->image) ?? asset('image/no-image.jpg') }})"
						>
							<a href="{{ route('catalog.product', ['product_alias' => $color->alias]) }}">
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
					<div class="text">{!! $product->description->description !!}</div>
					@php

						$a = $product->images->count();
						$a = rand(0, $a - 1);

					@endphp
					<div class="rand-picture"><img src="{{ asset($product->images[$a]->src) }}"></div>
				</div>
				<div v-show="tabs.sizes.isActive">Размеры</div>
				<div v-show="tabs.shipping.isActive">shipping</div>
				<div v-show="tabs.refund.isActive">refund</div>
				<div v-show="tabs.comments.isActive">comments</div>
				<div v-show="tabs.guarantees.isActive">guarantees</div>
			</div>
			<div class="live-chat">
				<button @click="$jivo.open"><span class="online-dot"></span> Online-чат с менеждером</button>
			</div>


			<tabs-items v-model="tabs">
				<!-- <tab-item :key="1">Описание</tab-item>
				<tab-item :key="2">Размеры</tab-item>
				<tab-item :key="3">Отзывы</tab-item>
				<tab-item :key="4">Оплата и доставка</tab-item>
				<tab-item :key="5">Обмен и возврат</tab-item>
				<tab-item :key="6">Гарантии</tab-item> -->
			</tabs-items>
			<tabs-content v-model="tabs">
				<!-- <tab-content :key="1">{!! $product->description->description !!}</tab-content>
				<tab-content :key="2">Размеры</tab-content>
				<tab-content :key="3">shipping</tab-content>
				<tab-content :key="4">refund</tab-content>
				<tab-content :key="5">comments</tab-content>
				<tab-content :key="6">guarantees</tab-content> -->
			</tabs-content>
		</div>
		@include('snippets.shop-product-gallery')
		@include('snippets.shop-product-found_cheaper_modal')
	</div>
</div>
</template>