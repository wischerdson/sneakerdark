<template id="template__catalog_collection">
	<div id="template_catalog_collection" class="container large">
		<div class="header">
			<div class="top">
				<h1>{{ $collection->title }}</h1>
				<div class="total-products">@{{ total }} @{{ totalSubject }}</div>
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
					<radio v-model="sort" name="sort" :value="1">по умолчанию</radio>
					<radio v-model="sort" name="sort" :value="2">по возрастанию цены</radio>
					<radio v-model="sort" name="sort" :value="3">по убыванию цены</radio>
				</div>
			</div>
		</div>
	
		<div v-show="firstLoad" class="preloader-wrapper"><div class="preloader"></div></div>

		<laradata name="api.catalog">{{ route('api.catalog.show', ['catalog' => $collection->id]) }}</laradata>

		<div class="main-content" v-show="!firstLoad">
			<div class="left-side">
				<snippet-catalog-collection-filters></snippet-catalog-collection-filters>
			</div>
			<div>
				<transition-group
					name="product-list"
					tag="ul"
					class="products-grid"
				>
					<li
						is="snippet-catalog-collection-product"
						v-for="(product, index) in products"
						:key="'products_block_' + index"
						:product-id="product.id"
						:title="product.title"
						:picture="product.pictures[0].src"
						:vendor="product.vendor"
						:price="product.price"
						:url="product.url"
						:sizes="product.sizes"
					></li>
				</transition-group>
				<snippet-catalog-collection-product style="display: none"></snippet-catalog-collection-product>
				
				<div v-show="productsNotFound" class="no-products-found">По таким фильтрам товаров не нашлось :(</div>
			</div>
		</div>

		<nav v-show="pagination && pagination.last_page !== 1 && !wait && !firstLoad">
			<ul class="pagination">
				<li 
					class="page-item"
					v-show="!pagination.on_first_page"
				>
					<a :href="$url.setParams({page: pagination.current_page - 1})" class="page-link"></a>
				</li>

				<li
					class="page-item"
					:class="{active: pagination.on_first_page}"
				>
					<a :href="$url.setParams({page: 1})" class="page-link">1</a>
				</li>

				<li v-if="pagination.current_page >= 6" class="page-item disabled"><span class="page-link">...</span></li>

				<li
					v-for="(page, index) in pagination.pages"
					class="page-item"
					:class="{active: page == pagination.current_page}"
					:key="`pagination_link_${index}`"
				>
					<a :href="$url.setParams({page})" class="page-link">@{{ page }}</a>
				</li>

				<li
					v-if="pagination.current_page <= pagination.last_page - 5"
					class="page-item disabled"
				><span class="page-link">...</span></li>

				<li
					class="page-item"
					:class="{active: pagination.last_page == pagination.current_page}"
				>
					<a :href="$url.setParams({page: pagination.last_page})" class="page-link">@{{ pagination.last_page }}</a>
				</li>

				<li
					v-show="pagination.has_more_pages"
					class="page-item"
				>
					<a :href="$url.setParams({page: pagination.current_page + 1})" class="page-link"></a>
				</li>
			</ul>
		</nav>
	</div>
</template>



@include('snippets.catalog-collection-product')
@include('snippets.catalog-collection-filters')