<template id="template__section_collections">
	<div id="section_collections">
		<div class="container large">
			<div class="section-title">
				<h2>Коллекции</h2>
				<hr>
			</div>
			<ul class="collection-list">
				<li class="collection-item square">
					<a class="inner" href="#">
						<div class="image" style="background-image: url({{ asset('/image/collection-image-0.jpg') }})"></div>
						<div class="overlay"></div>
						<div class="bottom">
							<div class="text">Зима @include('svg.arrow-right')</div>
							<div class="gradient"></div>
						</div>
					</a>
				</li>
				<li class="collection-item square">
					<a class="inner" href="#">
						<div class="image" style="background-image: url({{ asset('/image/collection-image-1.png') }})"></div>
						<div class="overlay"></div>
						<div class="bottom">
							<div class="text">Женские кроссовки @include('svg.arrow-right')</div>
							<div class="gradient"></div>
						</div>
					</a>
				</li>
				<li class="collection-item square">
					<a class="inner" href="#">
						<div class="image" style="background-image: url({{ asset('/image/collection-image-2.png') }})"></div>
						<div class="overlay"></div>
						<div class="bottom">
							<div class="text">Мужские кроссовки @include('svg.arrow-right')</div>
							<div class="gradient"></div>
						</div>
					</a>
				</li>
				<li class="collection-item square">
					<a class="inner" href="#">
						<div class="image" style="background-image: url({{ asset('/image/collection-image-3.png') }})"></div>
						<div class="overlay"></div>
						<div class="bottom">
							<div class="text">Женская одежда @include('svg.arrow-right')</div>
							<div class="gradient"></div>
						</div>
					</a>
				</li>
				<li class="collection-item square">
					<a class="inner" href="#">
						<div class="image" style="background-image: url({{ asset('/image/collection-image-4.png') }})"></div>
						<div class="overlay"></div>
						<div class="bottom">
							<div class="text">Мужская одежда @include('svg.arrow-right')</div>
							<div class="gradient"></div>
						</div>
					</a>
				</li>
				<li class="collection-item square">
					<a class="inner" href="#">
						<div class="image" style="background-image: url({{ asset('/image/collection-image-5.png') }})"></div>
						<div class="overlay"></div>
						<div class="bottom">
							<div class="text">Аксессуары @include('svg.arrow-right')</div>
							<div class="gradient"></div>
						</div>
					</a>
				</li>
			</ul>
		</div>
	</div>
</template>