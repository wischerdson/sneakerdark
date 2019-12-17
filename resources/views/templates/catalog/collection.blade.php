<template id="template__catalog_collection">
	<div id="template_catalog_collection" class="container large">
		<div class="header">
			<breadcrumb>
				<breadcrumb-item url="{{ route('home') }}">Главная</breadcrumb-item>
				@foreach ($collectionsChain as $category)
				<breadcrumb-item url="{{ route('catalog', ['collection_id' => $category->id]) }}">{{ $category->title }}</breadcrumb-item>
				@endforeach
			</breadcrumb>

			<div class="sort">
				Сортировать
				<a href="#" class="active">по умолчанию</a>
				<a href="#">по возрастанию цены</a>
				<a href="#">по убыванию цены</a>
			</div>
		</div>
	
		<div ref="catalogUrl" style="display: none;">{{ route('api.catalog.show', ['catalog' => $currentCollection->id]) }}</div>

		<div class="main-content" v-show="showCatalog">
			<div class="left-side">
				<snippet-catalog-collection-filters></snippet-catalog-collection-filters>
			</div>
			<ul class="products-grid">
				<snippet-catalog-collection-product
					v-for="(product, index) in products"
					:key="'products_block_' + index"
					:title="product.title"
					:picture="product.pictures[0].src"
					:vendor="product.vendor"
					:price="product.price"
					:url="'{{ route('catalog.product') }}' + product.id"
				></snippet-catalog-collection-product>
				<snippet-catalog-collection-product style="display: none"></snippet-catalog-collection-product>
			</ul>
		</div>

		{{ $products->links() }}
	</div>
</template>



@include('snippets.catalog-collection-product')
@include('snippets.catalog-collection-filters')