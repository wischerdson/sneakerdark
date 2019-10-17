<template id="template__shop_product">
	<div class="container" id="template_shop_product">
		<div class="top">

			<div class="images">
				<div class="main-image square">
					<div style="background-image: url({{ $product->pictures[0]->src }})"></div>
				</div>
				<ul class="image-list">
					<li class="image-item"></li>
				</ul>
			</div>
			<div class="text">
				<div class="vendor">{{ $product->vendor }}</div>
				<h2>{{ $product->title }}</h2>
				<div class="article">Артикул: <span>{{ $product->article }}</span></div>
				<div class="price">{{ $product->price }}.00 руб.</div>
				<ul class="parameter-list">
					@foreach ($product->parameters as $parameter)
					<li class="parameter-item">
						<span class="parameter-key">{{ $parameter->key }}:</span>
						<span class="parameter-value">{{ $parameter->value }}</span>
					</li>
					@endforeach
				</ul>
				
			</div>
		</div>
		<div class="bottom">
			<div class="description">Описание: <br>{!! $product->description !!}<script type="text/javascript">alert('Атака')</script></div>
		</div>
	</div>
</template>