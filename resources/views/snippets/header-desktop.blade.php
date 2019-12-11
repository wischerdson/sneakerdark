<div class="desktop">
	<div class="top">
		<a class="brand" href="{{ route('home') }}">
			<div class="brand-logo">@include('svg.brand-logo')</div>
			<div class="text">
				<div class="brand-name">@include('svg.brand-name')</div>
				<div class="description">Магазин одежды, обуви и аксессуаров</div>
			</div>
		</a>
		<div class="right">
			<div class="call">
				<a class="phone-number" href="tel:89101127174">+7 (800) 700 32-23 | Звонок бесплатный</a>
			</div>
			<a class="btn auth-btn">@include('svg.user')Войти</a>
		</div>
	</div>

	<div class="bottom">
		<div class="left">
			<div class="link-list">
				<div class="brand-logo-wrapper">
					<a class="brand-logo" href="{{ route('home') }}">@include('svg.brand-logo')</a>
				</div>
				<ul class="movable">
					<li class="link-item">
						<a href="{{ route('home') }}">Главная</a>
					</li>
					<li class="link-item">
						<a class="notification" href="{{ route('brands') }}">Новинки</a>
					</li>
					<li class="link-item">
						<a href="{{ route('brands') }}">Бренды</a>
					</li>
					<li class="link-item">
						<a
							href="{{ route('catalog', ['collection_id' => '1789']) }}"
							@mouseover="submenu._1 = true"
							@mouseout="submenu._1 = false"
							:class="{active: submenu._1}"
						>Мужское</a>
					</li>
					<li class="link-item">
						<a
							href="{{ route('catalog', ['collection_id' => '4']) }}"
							@mouseover="submenu._2 = true"
							@mouseout="submenu._2 = false"
							:class="{active: submenu._2}"
						>Женское</a>
					</li>
					<li class="link-item">
						<a
							href="{{ route('catalog', ['collection_id' => '3']) }}"
							@mouseover="submenu._3 = true"
							@mouseout="submenu._3 = false"
							:class="{active: submenu._3}"
						>Аксессуары</a>
					</li>
					<li class="link-item">
						<a href="#">Отзывы</a>
					</li>
					<li class="link-item">
						<a @click="jivo_openDialog"><span class="online-dot"></span>Online-чат с менеджером</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="right">
			<button class="search-btn btn" @click="openSearch">
				@include('svg.magnifying-glass')Поиск
			</button>
			<a href="#" class="btn wishlist">@include('svg.wishlist_filled')</a>
			<a class="btn primary shopping-cart-btn" @click="$store.commit('cartIsOpen', true)">
				@include('svg.shopping-bag')
				Корзина
			</a>
		</div>
	</div>


	<!-- Мужское -->
	<transition name="submenu-fade">
		<div
			class="submenu"
			v-show="submenu._1"
			@mouseover="submenu._1 = true"
			@mouseout="submenu._1 = false"
		>
			<div class="inner">
				<div class="column">
					<div class="column-heading">Heading #1</div>
					<div class="column-content">
						<ul class="link-list">
							<li class="link-item"><a href="#" class="link">Link #1</a></li>
							<li class="link-item"><a href="#" class="link">Link #2</a></li>
							<li class="link-item"><a href="#" class="link">Link #3</a></li>
							<li class="link-item"><a href="#" class="link">Link #4</a></li>
							<li class="link-item"><a href="#" class="link">Link #5</a></li>
						</ul>
					</div>
				</div>
				<div class="column">
					<div class="column-heading">Heading #2</div>
					<div class="column-content">
						<ul class="link-list">
							<li class="link-item"><a href="#" class="link">Link #1</a></li>
							<li class="link-item"><a href="#" class="link">Link #2</a></li>
							<li class="link-item"><a href="#" class="link">Link #3</a></li>
							<li class="link-item"><a href="#" class="link">Link #4</a></li>
							<li class="link-item"><a href="#" class="link">Link #5</a></li>
							<li class="link-item"><a href="#" class="link">Link #6</a></li>
						</ul>
					</div>
				</div>
				<div class="column">
					<div class="column-heading"> </div>
					<div class="column-content">
						<ul class="link-list">
							<li class="link-item"><a href="#" class="link">Link #7</a></li>
							<li class="link-item"><a href="#" class="link">Link #8</a></li>
						</ul>
					</div>
				</div>
				<div class="column">
					<div class="column-content">
						<a href="#" class="link-as-image">
							<div class="overlay"></div>
							<div class="image" style="background-image: url({{ asset('image/429819.jpg') }})"></div>
							<span class="text">Пуловеры</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</transition>

	<!-- Женское -->
	<transition name="submenu-fade">
		<div
			class="submenu"
			v-show="submenu._2"
			@mouseover="submenu._2 = true"
			@mouseout="submenu._2 = false"
		>
			<div class="inner">
				<div class="column">
					<div class="column-heading">Heading #1</div>
					<div class="column-content">
						<ul class="link-list">
							<li class="link-item"><a href="#" class="link">Link #1</a></li>
							<li class="link-item"><a href="#" class="link">Link #2</a></li>
							<li class="link-item"><a href="#" class="link">Link #3</a></li>
							<li class="link-item"><a href="#" class="link">Link #4</a></li>
							<li class="link-item"><a href="#" class="link">Link #5</a></li>
						</ul>
					</div>
				</div>
				<div class="column">
					<div class="column-heading">Heading #2</div>
					<div class="column-content">
						<ul class="link-list">
							<li class="link-item"><a href="#" class="link">Link #1</a></li>
							<li class="link-item"><a href="#" class="link">Link #2</a></li>
							<li class="link-item"><a href="#" class="link">Link #3</a></li>
							<li class="link-item"><a href="#" class="link">Link #4</a></li>
							<li class="link-item"><a href="#" class="link">Link #5</a></li>
							<li class="link-item"><a href="#" class="link">Link #6</a></li>
						</ul>
					</div>
				</div>
				<div class="column">
					<div class="column-heading"> </div>
					<div class="column-content">
						<ul class="link-list">
							<li class="link-item"><a href="#" class="link">Link #7</a></li>
							<li class="link-item"><a href="#" class="link">Link #8</a></li>
						</ul>
					</div>
				</div>
				<div class="column">
					<div class="column-content">
						<a href="#" class="link-as-image">
							<div class="overlay"></div>
							<div class="image" style="background-image: url({{ asset('image/465011.jpg') }})"></div>
							<span class="text">Пуховики</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</transition>

	<!-- Аксессуары -->
	<transition name="submenu-fade">
		<div
			class="submenu"
			v-show="submenu._3"
			@mouseover="submenu._3 = true"
			@mouseout="submenu._3 = false"
		>
			<div class="inner">
				<div class="column">
					<div class="column-heading">Heading #1</div>
					<div class="column-content">
						<ul class="link-list">
							<li class="link-item"><a href="#" class="link">Link #1</a></li>
							<li class="link-item"><a href="#" class="link">Link #2</a></li>
							<li class="link-item"><a href="#" class="link">Link #3</a></li>
							<li class="link-item"><a href="#" class="link">Link #4</a></li>
							<li class="link-item"><a href="#" class="link">Link #5</a></li>
						</ul>
					</div>
				</div>
				<div class="column">
					<div class="column-heading">Heading #2</div>
					<div class="column-content">
						<ul class="link-list">
							<li class="link-item"><a href="#" class="link">Link #1</a></li>
							<li class="link-item"><a href="#" class="link">Link #2</a></li>
							<li class="link-item"><a href="#" class="link">Link #3</a></li>
							<li class="link-item"><a href="#" class="link">Link #4</a></li>
							<li class="link-item"><a href="#" class="link">Link #5</a></li>
							<li class="link-item"><a href="#" class="link">Link #6</a></li>
						</ul>
					</div>
				</div>
				<div class="column">
					<div class="column-heading"> </div>
					<div class="column-content">
						<ul class="link-list">
							<li class="link-item"><a href="#" class="link">Link #7</a></li>
							<li class="link-item"><a href="#" class="link">Link #8</a></li>
						</ul>
					</div>
				</div>
				<div class="column">
					<div class="column-content">
						<a href="#" class="link-as-image">
							<div class="overlay"></div>
							<div class="image" style="background-image: url(https://mtdata.ru/u12/photoBB31/20762780747-0/original.jpg)"></div>
							<span class="text">Пиво. Новые<br>поступления</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</transition>
</div>