<template id="template__section_catalog">
	<div id="section_catalog" class="container large">
		<div class="section-title">
			<h2>Новинки</h2>
			<hr>
		</div>

		<ul class="product-grid">
			@foreach ($newProducts as $product)
			<snippet-product
				title="{{ $product->description->name }}"
				picture="{{ asset($product->image) }}"
				vendor="{{ $product->description->vendor }}"
				url="{{ route('catalog.product', ['product_alias' => $product->alias]) }}"
				:price="{{ $product->price }}"
				:productId="{{ $product->id }}"
				:sizes="[
					@if ($product->sizes->count())
						@foreach ($product->sizes[0]->values as $size)
					{instock: {{ $size->instock }}, value: '{{ $size->value}}'},
						@endforeach
					@endif
				]"
			></snippet-product>
			@endforeach
		</ul>
	</div>
</template>

@include('snippets.catalog-collection-product')