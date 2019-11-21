<template id="template__section_welcome">
	<div id="section_welcome">
		<div class="container">
			<div class="block">
				<div class="image" style="background-image: url(http://image.kokette.ru/files/products/24469.jpg)"></div>
				<div class="text-wrapper">
					<div class="name">
						<div class="outer">
							<div class="inner"><a href="#">Женское</a></div>
						</div>
					</div>
					<div class="links">
						<ul class="link-list">
							<li
								v-for="(link, key) in womanLinks"
								class="link-item"
								:style="`transition-delay: ${key * 0.4 / womanLinks.length}s`"
							>
								<a href="#">@{{ link }}</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="block">
				<div class="image" style="background-image: url(https://pp.userapi.com/c849036/v849036711/1de96a/-HN__TMfgoY.jpg)"></div>
				<div class="text-wrapper">
					<div class="name">
						<div class="outer">
							<div class="inner"><a href="#">Мужское</a></div>
						</div>
					</div>
					<div class="links">
						<ul class="link-list">
							<li
								v-for="(link, key) in womanLinks"
								class="link-item"
								:style="`transition-delay: ${key * 0.4 / womanLinks.length}s`"
							>
								<a href="#">@{{ link }}</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- <div class="welcome-link">
				<div class="image" style="background-image: url(https://pp.userapi.com/c854028/v854028524/a734b/PYD3xry99uE.jpg)"></div>
				<a href="{{ route('catalog', ['collection_id' => '123']) }}">Мужское</a>
			</div>
			<div class="welcome-link">
				<div class="image" style="background-image: url(https://pp.userapi.com/c849036/v849036711/1de96a/-HN__TMfgoY.jpg)"></div>
				<a href="#">Женское</a>
			</div> -->
		</div>
	</div>
</template>