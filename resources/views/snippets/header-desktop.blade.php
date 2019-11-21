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
			<button class="btn">@include('svg.user')Войти</button>
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
						<a href="{{ route('brands') }}">Бренды</a>
					</li>
					<li class="link-item">
						<a href="{{ route('catalog', ['collection_id' => '1789']) }}">Кроссовки</a>
						<ul class="submenu">
							<li class="submenu-item"><a href="{{ route('catalog', ['collection_id' => '1']) }}">Мужские</a></li>
							<li class="submenu-item"><a href="{{ route('catalog', ['collection_id' => '97']) }}">Женские</a></li>
						</ul>
					</li>
					<li class="link-item">
						<a href="{{ route('catalog', ['collection_id' => '4']) }}">Одежда</a>
						<ul class="submenu">
							<li class="submenu-item"><a href="{{ route('catalog', ['collection_id' => '1597']) }}">Мужская</a></li>
							<li class="submenu-item"><a href="{{ route('catalog', ['collection_id' => '1596']) }}">Женская</a></li>
						</ul>
					</li>
					<li class="link-item">
						<a href="{{ route('catalog', ['collection_id' => '3']) }}">Аксессуары</a>
						<ul class="submenu">
							<li class="submenu-item">
								<a href="#">Зимние</a>
								<ul class="submenu submenu-2">
									<li class="submenu-item"><a href="{{ route('catalog', ['collection_id' => '1597']) }}">Шапки</a></li>
									<li class="submenu-item"><a href="{{ route('catalog', ['collection_id' => '1596']) }}">Шарфы</a></li>
									<li class="submenu-item"><a href="{{ route('catalog', ['collection_id' => '1596']) }}">Перчатки</a></li>
									<li class="submenu-item"><a href="{{ route('catalog', ['collection_id' => '1596']) }}">Варежки</a></li>
								</ul>
							</li>
							<li class="submenu-item"><a href="#">Рюкзаки и сумки</a></li>
								<!-- 
									Рюкзаки
									Сумки
									Сумки на пояс
								-->
								<li class="submenu-item"><a href="#">Прочее</a></li>
								<!-- 
									Наручные часы
									Гаджеты
									Солнцезащитные очки
									Кошельки
									Ремни
									Кепки
								-->
								<li class="submenu-item"><a href="#">Панамы</a></li>
							</ul>
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
				<button class="search btn" @click="openSearch">
					@include('svg.magnifying-glass')
				</button>
				<a href="#" class="btn wishlist">@include('svg.wishlist_filled')</a>
				<a class="btn primary shopping-cart" @click="$store.commit('cartIsOpen', true)">
					@include('svg.shopping-bag')
					Корзина
				</a>
			</div>
		</div>
	</div>