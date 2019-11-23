<template id="template__catalog_collection">
	<div id="template_catalog_collection" class="container large">
		<div class="header">
			<breadcrumb>
				<breadcrumb-item url="{{ route('home') }}">Главная</breadcrumb-item>
				@foreach ($categoriesChain as $category)
				<breadcrumb-item url="{{ route('catalog', ['collection_id' => $category->id]) }}">{{ $category->name }}</breadcrumb-item>
				@endforeach
			</breadcrumb>

			<div class="sort">
				Сортировать
				<a href="#" class="active">по умолчанию</a>
				<a href="#">по возрастанию цены</a>
				<a href="#">по убыванию цены</a>
			</div>
		</div>

		<div class="main-content">
			<div class="left-side">
				<snippet-catalog-collection-filters></snippet-catalog-collection-filters>
			</div>
			<ul class="products-grid">
				@foreach ($products as $product)
				<snippet-catalog-collection-product
					title="{{ $product->title }}"
					picture="{{ $product->pictures[0]->src }}"
					vendor="{{ $product->vendor }}"
				></snippet-catalog-collection-product>
				@endforeach
			</ul>
		</div>

		{{ $products->links() }}
	</div>
</template>



@include('snippets.catalog-collection-product')
@include('snippets.catalog-collection-filters')