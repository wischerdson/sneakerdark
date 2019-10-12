@extends('layouts.default')


@section('content')

<div class="welcome">
	<div id="slider_prev" class="arrow to-left"><i class="material-icons">keyboard_arrow_left</i></div>
	<div class="slider">
		<div class="slide" style="background-image: url(https://pp.userapi.com/c854028/v854028524/a734b/PYD3xry99uE.jpg)"></div>
		<div class="slide" style="background-image: url(https://pp.userapi.com/c855128/v855128028/9f742/oPAFUPsgPZk.jpg)"></div>
		<div class="slide" style="background-image: url(https://pp.userapi.com/c849036/v849036711/1de96a/-HN__TMfgoY.jpg)"></div>
	</div>
	<div id="slider_next" class="arrow to-right"><i class="material-icons">keyboard_arrow_right</i></div>
	<div class="slider-navigation"></div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.slider').slick({
			autoplay: true,
			pauseOnDotsHover: true,
			pauseOnHover: false,
			prevArrow: '#slider_prev',
			nextArrow: '#slider_next',
			dots: true,
			appendDots: '.slider-navigation'
		});
	});
</script>

<section id="collections">
	<div class="wrapper">
		<div class="section-header">
			<h2>Коллекции</h2>
			<hr>
		</div>
		<ul class="link-list">
			<li class="link-item">
				<div class="image" style="background-image: url({{ asset('/image/collection-image-1.png') }})"></div>
				<a href="#">Мужские кроссовки</a>
			</li>
			<li class="link-item">
				<div class="image" style="background-image: url({{ asset('/image/collection-image-2.png') }})"></div>
				<a href="#">Женские кроссовки</a>
			</li>
			<li class="link-item">
				<div class="image" style="background-image: url({{ asset('/image/collection-image-3.png') }})"></div>
				<a href="#">Мужская одежда</a>
			</li>
			<li class="link-item">
				<div class="image" style="background-image: url({{ asset('/image/collection-image-4.png') }})"></div>
				<a href="#">Женские одежда</a>
			</li>
			<li class="link-item">
				<div class="image" style="background-image: url({{ asset('/image/collection-image-5.png') }})"></div>
				<a href="#">Аксессуары</a>
			</li>
		</ul>
	</div>
</section>

@endsection