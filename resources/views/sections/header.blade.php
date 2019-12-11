<template id="template__section_header">
	@if ($transparentHeader)
		<div class="header-wrapper">
			<header
				id="section_header"
				:class="{
					'transparent': !isMoving && !$store.state.searchIsOpen && !submenuIsOpen,
					'moving': isMoving,
					'searchIsOpen': $store.state.searchIsOpen
				}"
			>
				@include('snippets.header-desktop')
				@include('snippets.header-mobile')
			</header>
		</div>
	@else
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
	@endif
	
</template>