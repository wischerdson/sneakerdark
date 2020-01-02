<template id="template__snippet_catalog_collection_filters" >
	<div>
		<div class="filters" ref="filters">
			<div
				class="filters-section"
				v-for="(filter, key) in filters"
				v-if="key != 'price'"
				:key="`filter_block_${key}`"
			>
				<div class="section-title">@{{ filter.title }}</div>
				<div class="section-body">
					<has-scroll>
						<checkbox
							name="filters_category"
							v-for="(item, index) in filter.list"
							:key="`filter_entity_${index}`"
							v-model="appliedFilters[key]"
							:value="item"
						>@{{ item }}</checkbox>
					</has-scroll>
				</div>
			</div>
			<checkbox style="display: none;"></checkbox>
			@{{ asd }}
			<!-- <div class="filters-section" v-show="genderSection">
				<div class="section-title">Пол</div>
				<div class="section-body">
					<checkbox
						name="filters_gender"
						v-for="(gender, index) in getFilters.gender"
						:key="'filter_gender_' + index"
						v-model="filters.gender"
						:value="gender"
					>@{{ gender }}</checkbox>
				</div>
			</div>
			<div class="filters-section" v-show="sizeSection">
				<div class="section-title">Размер</div>
				<div class="section-body">
					<has-scroll class_="sizes">
						<checkbox
							name="filters_size"
							v-for="(size, index) in getFilters.size"
							:key="'filter_size_' + index"
							v-model="filters.size"
							:value="size"
						>@{{ size }}</checkbox>
					</has-scroll>
				</div>
			</div>

			<div class="filters-section" v-show="brandSection">
				<div class="section-title">Бренд</div>
				<div class="section-body">
					<has-scroll color="rgba(255,255,255,.75)">
						<checkbox
							name="filters_brand"
							v-for="(brand, index) in getFilters.brand"
							:key="'filter_brand_' + index"
							v-if="brand"
							v-model="filters.brand"
							:value="brand"
						>@{{ brand }}</checkbox>
						<checkbox name="blank" style="display: none;"></checkbox>
					</has-scroll>
				</div>
			</div>
			<div class="filters-section">
				<div class="section-title">Цена</div>
				<div class="section-body price">
					<price-range-slider
						v-model="filters.price"
						:min="priceLimits.min"
						:max="priceLimits.max"
						:start="filters.price"
					></price-range-slider>
				</div>
			</div> -->
		</div>
	</div>
</template>