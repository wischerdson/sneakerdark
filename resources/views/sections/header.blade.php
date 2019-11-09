<template id="template__section_header">
	<header
		id="section_header"
		:class="{
				'moving': isMoving,
				'searchIsOpen': $store.state.searchIsOpen
		}"
	>
		@include('snippets.header-desktop')
		@include('snippets.header-mobile')
	</header>
</template>