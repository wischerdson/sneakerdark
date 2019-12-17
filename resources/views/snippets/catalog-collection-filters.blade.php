<template id="template__snippet_catalog_collection_filters" >
	<sticky :margin-top="20 + 50">
		<div class="filters" ref="filters">
			<div class="filters-section">
				<div class="section-title">Категория</div>
				<div class="section-body">
					<has-scroll color="rgba(255,255,255,.75)">
						<checkbox
							name="filters_category"
							v-for="(category, index) in filters.category"
							:key="'filter_category_' + index"
						>@{{ category }}</checkbox>
					</has-scroll>
				</div>
			</div>
			<div class="filters-section">
				<div class="section-title">Пол</div>
				<div class="section-body">
					<checkbox
						name="filters_gender"
						v-for="(gender, index) in filters.gender"
						:key="'filter_gender_' + index"
					>@{{ gender }}</checkbox>
				</div>
			</div>
			<div class="filters-section">
				<div class="section-title">Размер</div>
				<div class="section-body">
					<has-scroll color="rgba(255,255,255,.75)" class_="sizes">
						<checkbox
							name="filters_size"
							v-for="(size, index) in filters.size"
							:key="'filter_size_' + index"
						>@{{ size }}</checkbox>
					</has-scroll>
				</div>
			</div>

			<div class="filters-section">
				<div class="section-title">Бренд</div>
				<div class="section-body">
					<has-scroll color="rgba(255,255,255,.75)">
						<checkbox
							name="filters_brand"
							v-for="(brand, index) in filters.brand"
							:key="'filter_brand_' + index"
							v-if="brand"
						>@{{ brand }}</checkbox>
						<checkbox name="blank" style="display: none;"></checkbox>
					</has-scroll>
				</div>
			</div>
			<div class="filters-section">
				<div class="section-title">Цена</div>
				<div class="section-body price">
					<div ref="range"></div>
					<div class="row">
						<input type="number" name="price_min" class="form-control" v-model.lazy="price.min">
						<div class="separator"></div>
						<input type="number" name="price_max" class="form-control" v-model.lazy="price.max">
					</div>
				</div>
			</div>
		</div>
	</sticky>
</template>