<template id="template__legal_refund">
	<div id="template_legal_refund">
		<div class="container">
			<breadcrumb>
				<breadcrumb-item url="{{ route('home') }}">Главная</breadcrumb-item>
				<breadcrumb-item>Обмен и возврат</breadcrumb-item>
			</breadcrumb>

			<h1>Обмен и возврат</h1>

			<section-legal-refund></section-legal-refund>
		</div>
	</div>
</template>

@include('sections.legal-refund')