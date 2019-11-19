<transition name="fade-gallery">
	<div class="gallery" v-show="galleryIsOpen">
		<div class="arrow-wrapper">
			<button ref="galleryPrevSlideArrow" class="arrow">@include('svg.keyboard-arrow-left')</button>
		</div>
		<button class="close" @click="galleryIsOpen = false">@include('svg.cross')</button>
		<ul class="picture-list" ref="gallery">
			@foreach ($product->pictures as $picture)
			<li class="picture-item">
				<img src="{{ $picture->src }}">
			</li>
			@endforeach
		</ul>
		<div ref="galleryNavigation" class="gallery-navigation"></div>
		<div class="arrow-wrapper">
			<button ref="galleryNextSlideArrow" class="arrow">@include('svg.keyboard-arrow-right')</button>
		</div>
	</div>
</transition>