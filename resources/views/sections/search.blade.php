<template id="template__section_search">
	<transition name="search">
		<div id="section_search" v-show="isOpen">
			<div class="top-bar">
				<div class="content">
					<div class="form-group">
						<div class="field">
							<input
								v-model="$store.state.searchQuery"
								type="text"
								class="search-field form-control"
								placeholder="Поиск по названию, модели, бренду или артикулу"
							>
							<div class="postfix">@include('svg.magnifying-glass')</div>
						</div>
					</div>
					<div class="close-btn" @click="$store.commit('searchIsOpen', false)">@include('svg.cross')</div>
				</div>
			</div>
			<div class="for-whom">
				<div class="content">
					<div class="item">
						<input type="radio" v-model="gender" name="forwhom" id="her" value="Женский">
						<label for="her">Для нее</label>
					</div>
					<div class="item">
						<input type="radio" v-model="gender" name="forwhom" id="him" value="Мужской">
						<label for="him">Для него</label>
					</div>
					<div class="count-matches" v-show="!ajaxStatus.waiting && (searchQuery || searchResults.length)">Найдено @{{ searchResults.length }}</div>
				</div>
			</div>
			<div class="body">
				<div class="field-is-empty-notice" v-if="!searchQuery && !searchResults.length">
					<center>
						@include('svg.magnifying-glass')
						<p>Введите поисковый запрос</p>
						<p>Например "Кроссовки Adidas Yeezy 350"</p>
					</center>
				</div>
				<div v-if="ajaxStatus.waiting" class="preloader-wrapper"><div class="preloader"></div></div>
				<ul class="results" v-if="searchResults && !ajaxStatus.waiting">
					<snippet-search-result
						v-for="(value, index) in searchResults"
						v-if="index < 11"
						:name="value.title"
						:article="value.article"
						:price="value.price"
						:image="getPicture(value.pictures)"
						:sizes="value.sizes"
						:key="index"
					></snippet-search-result>
					<a href="#" v-show="searchResults.length > 10" class="show-all-results"><span>Посмотреть все результаты &#8594;</span></a>
				</ul>
			</div>
			<!-- <a href="#" class="show-all-results-line" v-show="searchResults.length > 0">
				<div class="content">Посмотреть все результаты &#8594;</div>
			</a> -->
		</div>
	</transition>
</template>