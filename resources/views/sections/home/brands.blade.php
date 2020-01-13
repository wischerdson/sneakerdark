<template id="template__section_brands">
	<div id="section_brands" class="container large">
		<div class="title">
			<h2>Бренды</h2>
			<hr>
		</div>
		<div class="brands-row">
			<ul class="brand-list">
				<li class="brand-item" title="Adidas">
					<img src="{{ asset('image/brands/adidas.png') }}" alt="Adidas">
				</li>
				<li class="brand-item" title="Nike">
					<img src="{{ asset('image/brands/nike.png') }}" alt="Nike">
				</li>
				<li class="brand-item" title="Fila">
					<img src="{{ asset('image/brands/fila.png') }}" alt="Fila">
				</li>
				<li class="brand-item" title="New balance">
					<img src="{{ asset('image/brands/new-balance.png') }}" alt="New balance">
				</li>
				<li class="brand-item" title="Reebok">
					<img src="{{ asset('image/brands/reebok.png') }}" alt="Reebok">
				</li>
				<li class="brand-item" title="Asics">
					<img src="{{ asset('image/brands/asics.png') }}" alt="Asics">
				</li>
				<li class="brand-item" title="Yeezy">
					<img src="{{ asset('image/brands/yeezy.png') }}" alt="Yeezy">
				</li>
				<li class="brand-item" title="Off-white">
					<img src="{{ asset('image/brands/off-white.png') }}" alt="Off-white">
				</li>
				<li class="brand-item" title="Balenciaga">
					<img src="{{ asset('image/brands/balenciaga.png') }}" alt="Balenciaga">
				</li>
			</ul>
			<div class="btn-wrapper">
				<a href="{{ route('brands') }}" class="btn primary">Посмотреть все</a>
			</div>
		</div>
	</div>
</template>