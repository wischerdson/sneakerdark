<template id="template__section_brands">

	<div>
		<div class="alphabetical-index">
			<div class="section-title">Алфавитный указатель</div>
			<ul class="letter-list">
				<li class="letter-item" v-for="letter in letters">
					<button class="letter btn" @click="filterByLetter(letter)">@{{ letter }}</button>
				</li>
			</ul>
		</div>

		<div class="brands">
			<div class="brands-section" v-for="(brandsInSection, letter) in brandList">
				<h2 class="section-title">@{{ letter }}</h2>
				<div class="brands-grid">
					<a class="brand-item" :href="brand.url" v-for="(brand, brandName) in brandsInSection">
						<div class="image-wrapper">
							<div class="image" :style="`background-image: url(${brand.image})`"></div>
						</div>
						<div class="name">@{{ brandName }}</div>
					</a>
				</div>
			</div>
		</div>
	</div>

</template>