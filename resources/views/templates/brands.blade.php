<template id="template__brands">

	<div id="template_brands" class="container large">
		<breadcrumb>
			<breadcrumb-item url="{{ route('home') }}">Главная</breadcrumb-item>
			<breadcrumb-item>Бренды</breadcrumb-item>
		</breadcrumb>
		<h1>Бренды</h1>
		<laradata name="brands" json>{{ json_encode($brands) }}</laradata>

		<div>
			<div class="alphabetical-index">
				<ul class="letter-list">
					<li class="letter-item" v-for="letter in letters">
						<button :class="['letter', 'btn', {active: letter == currentLetter}]" @click="filterByLetter(letter)">@{{ letter }}</button>
					</li>
				</ul>
			</div>

			<div class="brands">
				<li :key="`key_${letter}`" class="brands-section" v-for="(brandsInSection, letter) in brandList">
					<h2 class="section-title">@{{ letter }}</h2>
					<div class="brands-grid">
						<a class="brand-item" :href="brand.url" v-for="(brand, brandName) in brandsInSection">
							<div class="image-wrapper">
								<div class="image" :style="`background-image: url(${brand.image})`"></div>
							</div>
							<div class="name">@{{ brandName }}</div>
						</a>
					</div>
				</li>
			</div>
		</div>
	</div>


</template>