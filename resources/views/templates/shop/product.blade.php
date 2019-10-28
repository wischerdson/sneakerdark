<template id="template__shop_product" >
	<div class="container" id="template_shop_product">
		<div class="top">
			<div class="left">
				<div ref="sticky" style="position: relative;">
					<div ref="presentation">
						<div class="frame">
							<div class="arrow-nav">
								<div class="arrow" ref="sliderPrevArrow">@include('svg.keyboard-arrow-left')</div>
							</div>
							<div ref="pictures" @mousedown="enableZoom">
								@foreach ($product->pictures as $picture)
								<div class="image-wrapper">
									<div
									:class="['image', {'transition': zoomTransition}]"
									:style="`
									background-image: url({{ $picture->bizoutmax_src }});
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
							<div class="mini-image" style="background-image: url({{ $picture->bizoutmax_src }})"></div>
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
					<div>Артикул: <span>{{ $product->article }}</span></div>
					&nbsp;&nbsp;/&nbsp;&nbsp;
					<div>{{ $product->vendor }}</div>
					<div class="in-stock">В наличии</div>
				</div>
				<div class="price-wrapper">
					<div class="price">{{ $product->price }}</div>
					{{-- <div class="compare-at-price">{{ $product->price  * 4 }}</div> --}}
				</div>
				
				<ul class="parameter-list">
					@foreach ($product->parameters as $parameter)
					<li class="parameter-item">
						<span class="parameter-key">{{ $parameter->key }}</span>
						<span class="parameter-value">{{ $parameter->value }}</span>
					</li>
					@endforeach
				</ul>

				<div class="sizes-wrapper">
					<div class="title">Размер</div>
					<ul class="size-list">
						@foreach ($product->sizes as $size)
						@if ($size->instock !== 0)
						<li class="size-item" instock="{{ $size->instock }}">
							<input
							type="radio"
							name="size"
							id="size_{{ $size->bizoutmax_id }}"
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

				<div class="colors-wrapper">
					<div class="title">Доступные цвета</div>
					<ul class="color-list">
						@foreach ($product->colors as $color)
						<li
						class="color-item @if ($color->id == $product->id) current @endif"
						style="background-image: url({{ $color->pictures[0]->bizoutmax_src }})"
						>
						<a href="{{ route('shop.product', ['product_id' => $color->id]) }}">
							@if ($color->id == $product->id)
							<div class="tick">@include('svg.tick')</div>
							@endif
						</a>
					</li>
					@endforeach
				</ul>
			</div>


			<div class="buttons">
				<!-- <div class="btn primary buy">Оформить заказ</div> -->
				<div class="btn primary add-to-cart">Добавить в корзину @include('svg.shopping-bag')</div>
			</div>
		</div>
		<div class="bottom">
			<div class="description">Описание: <br>{!! $product->description !!}</div>
		</div>
	</div>
</div>
</template>