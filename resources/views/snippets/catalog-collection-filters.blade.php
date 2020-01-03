<template id="template__snippet_catalog_collection_filters" >
	<div>
		<div class="filters" ref="filters">
			<div
				class="filters-section"
				v-for="(filter, key) in filters"
				:key="`filter_block_${key}`"
			>
				<div v-if="key != 'price'">
					<div v-if="filter.list.length">
						<div class="section-title">@{{ filter.title }}</div>
						<div class="section-body">
							<has-scroll>
								<checkbox
									name="filters_category"
									v-for="(item, index) in filter.list"
									:key="`filter_entity_${index}`"
									v-if="item"
									v-model="appliedFilters[key]"
									:value="item"
								>@{{ item }}</checkbox>
							</has-scroll>
						</div>
					</div>
				</div>
				<div v-else>
					<div class="section-title">@{{ filter.title }}</div>
					<div class="section-body price">
						<price-range-slider
							v-if="!(priceLimits.min === priceLimits.max === 0)"
							v-model="appliedFilters.price"
							:range="priceLimits"
							:start="appliedFilters.price"
						></price-range-slider>
					</div>
				</div>
			</div>

			<checkbox style="display: none;"></checkbox>
		</div>
	</div>
</template>