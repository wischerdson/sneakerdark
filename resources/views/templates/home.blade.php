<template id="template__home">
	<div id="template_home">
		<section-welcome></section-welcome>
		<section-collections></section-collections>
		<section-catalog></section-catalog>
		<section-brands></section-brands>
	</div>
</template>

@include('sections.home.welcome')
@include('sections.home.collections')
@include('sections.home.catalog')
@include('sections.home.brands')