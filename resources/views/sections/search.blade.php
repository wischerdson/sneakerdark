<template id="template__section_search">
	<transition name="search">
		<div id="section_search" v-show="open">
			<laradata name="api.search">{{ route('search.ajax') }}</laradata>
			<div class="top-bar">
				<div class="content container large">
					<div class="form-group">
						<div class="field">
							<input
								v-model="search.query"
								type="text"
								class="search-field form-control"
								placeholder="Поиск по названию, модели, бренду или артикулу"
								id="searchField"
							>
							<div class="postfix">@include('svg.magnifying-glass')</div>
						</div>
					</div>
					<div class="close-btn" @click="$store.commit('search_close')">@include('svg.cross')</div>
				</div>
			</div>
			<div class="for-whom">
				<div class="container large">
					<div class="item">
						<input type="radio" v-model="search.gender" name="gender" id="all" value="all">
						<label for="all">Для всех</label>
					</div>
					<div class="item">
						<input type="radio" v-model="search.gender" name="gender" id="her" value="Женский">
						<label for="her">Для нее</label>
					</div>
					<div class="item">
						<input type="radio" v-model="search.gender" name="gender" id="him" value="Мужской">
						<label for="him">Для него</label>
					</div>
					<div class="count-matches" v-if="!wait && total">Найдено @{{ total }} @{{ totalSubject }}</div>
				</div>
			</div>
			<div class="body">
				<div class="field-is-empty-notice" v-if="!search.query">
					<center>
						@include('svg.magnifying-glass')
						<p>Введите поисковый запрос</p>
						<p>Например "Кроссовки Adidas Yeezy 350"</p>
					</center>
				</div>
				<div class="no-results-notice" v-if="search.query && !total && !wait && !w">
					<center>
						<p>По Вашему запросу не было найдено ни одного товара</p>
					</center>
				</div>
				<div v-if="wait" class="preloader-wrapper"><div class="preloader"></div></div>
				<ul class="results container large" v-if="results && !wait">
					<snippet-search-result
						v-for="(value, index) in results"
						:name="value.title"
						:article="value.article"
						:price="value.price"
						:image="getPicture(value.pictures, '{{ asset('/image/no-image.jpg') }}')"
						:sizes="value.sizes"
						:key="index"
						:url="value.url"
					></snippet-search-result>
					<a :href="`{{ route('search', ['query' => '123']) }}/${search.query}`" v-if="total > 9" class="show-all-results btn primary">Посмотреть все результаты  &#8594;</a>
				</ul>
			</div>
		</div>
	</transition>
</template>