<template id="template__brands">

	<div id="template_brands">

		

		<div class="container">
			<breadcrumb>
				<breadcrumb-item url="{{ route('home') }}">Главная</breadcrumb-item>
				<breadcrumb-item>Бренды</breadcrumb-item>
			</breadcrumb>
			<h1>Бренды</h1>
			<section-brands brands-json="{{ json_encode($brands) }}"></section-brands>
		</div>
	</div>

</template>

@include('sections.brands')