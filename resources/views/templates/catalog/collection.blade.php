<template id="template__catalog_collection">
	<div id="template_catalog_collection" class="container large">
		<div class="header">
			<div class="top">
				<h1>{{ $currentCollection->title }}</h1>
				<div class="total-products">@{{ $store.getters.getCatalog.total_products }} @{{ $store.getters.getCatalog.total_subject }}</div>
			</div>
			<div class="bottom">
				<breadcrumb>
					<breadcrumb-item url="{{ route('home') }}">Главная</breadcrumb-item>
					@foreach ($collectionsChain as $category)
						@if ($loop->last)
						<breadcrumb-item>{{ $category->title }}</breadcrumb-item>
						@else
						<breadcrumb-item url="{{ route('catalog', ['collection_id' => $category->id]) }}">{{ $category->title }}</breadcrumb-item>
						@endif
					@endforeach
				</breadcrumb>

				<div class="sort">
					Сортировать
					<a href="#">по умолчанию</a>
					<a href="#" class="active">по возрастанию цены</a>
					<a href="#">по убыванию цены</a>
				</div>
			</div>
			
		</div>
	
		<div ref="catalogUrl">{{ route('api.catalog.show', ['catalog' => $currentCollection->id]) }}</div>

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
					:url="product.url"
				></snippet-catalog-collection-product>
				<snippet-catalog-collection-product style="display: none"></snippet-catalog-collection-product>
			</ul>
		</div>

		{{ $products->links() }}
	</div>
</template>



@include('snippets.catalog-collection-product')
@include('snippets.catalog-collection-filters')