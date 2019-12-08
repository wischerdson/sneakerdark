<template id="template__section_welcome">
	<div id="section_welcome">
		<div class="slider" ref="welcomeSlider">
			<div class="slide">
				<div class="overlay"></div>
				<div class="image" style="background-image: url({{ asset('image/welcome-banner-1.jpg') }})"></div>
				<div class="content container">
					<div class="slide-title">Yeezy</div>
					<a href="#" class="btn primary">Подробнее</a>
				</div>
			</div>
			<div class="slide">
				<div class="overlay"></div>
				<div class="image" style="background-image: url({{ asset('image/welcome-banner-4.jpg') }})"></div>
				<div class="content container">
					<div class="slide-title">Nike</div>
					<a href="#" class="btn primary">Подробнее</a>
				</div>
			</div>
			<div class="slide">
				<div class="overlay"></div>
				<div class="image" style="background-image: url({{ asset('image/welcome-banner-3.jpg') }})"></div>
				<div class="content container">
					<div class="slide-title">Зима</div>
					<a href="#" class="btn primary">Подробнее</a>
				</div>
			</div>
			<div class="slide">
				<div class="overlay"></div>
				<div class="image" style="background-image: url({{ asset('image/welcome-banner-2.jpg') }})"></div>
				<div class="content container">
					<div class="slide-title">Air force</div>
					<a href="#" class="btn primary">Подробнее</a>
				</div>
			</div>
		</div>
		<div class="slider-navigation-wrapper container">
			<div class="slider-dots" ref="sliderDots"></div>
			<div class="slider-arrows">
				<button ref="sliderArrowToLeft">@include('svg.keyboard-arrow-left')</button>
				<button ref="sliderArrowToRight">@include('svg.keyboard-arrow-right')</button>
			</div>
		</div>
	</div>
</template>