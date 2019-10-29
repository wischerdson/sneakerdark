<template id="template__shop_product" >
	<div class="container" id="template_shop_product">
		<div class="left">
			<div class="sticky">
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
			<ul class="tab-list">
				<li
					@click="setActiveTab(tab)"
					v-for="tab in tabs"
					:class="[{'active': tab.isActive}, 'tab-item']"
				>
					@{{ tab.name }}
				</li>
			</ul>
			<div class="tab-content">
				<div class="description" v-show="tabs[0].isActive">{!! $product->description !!}</div>
				<div class="" v-show="tabs[1].isActive">Размеры</div>
				<div class="" v-show="tabs[2].isActive">
					Мы осуществляем доставку по РФ и СНГ<br>
Доставка почтой России<br>
Средние сроки доставки 5-15 дней<br>
<br><br>
Доставка СДЭК<br>
Средние сроки доставки 3-5 дней<br>
<p>Потребитель вправе обменять непродовольственный товар надлежащего качества на аналогичный товар у продавца, у которого этот товар был приобретен, если указанный товар не подошел по форме, габаритам, фасону, расцветке, размеру или комплектации</p>
				</div>
				<div class="" v-show="tabs[3].isActive">
					Оплатить заказ можно разными способами:<br>
- Банковской картой Visa или MasterCard<br>
- Электронными деньгами<br>
Гарантийные условия соответствуют закону РФ «О защите прав потребителей»
				</div>
			</div>
		</div>
	</div>
</div>
</template>