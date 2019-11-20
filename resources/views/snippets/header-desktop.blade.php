<div class="desktop">
	<div class="top">
		<a class="brand" href="{{ route('home') }}">
			<div class="brand-logo">@include('svg.brand-logo')</div>
			<div class="text">
				<div class="brand-name">@include('svg.brand-name')</div>
				<div class="description">Магазин одежды, обуви и аксессуаров</div>
			</div>
		</a>
		<div class="contacts">
			<div class="call">
				<div class="label">Звонок бесплатный</div>
				<a class="phone-number" href="tel:89101127174">8 910 112-71-74</a>
			</div>
			<div class="manager-contacts">
				<div class="label">Связь с менеджером</div>
				<div class="variants">
					<a href="#">@include('svg.contact-method-1')</a>
					<a href="#">@include('svg.contact-method-2')</a>
					<a href="#">@include('svg.contact-method-3')</a>
					<a href="#">@include('svg.contact-method-4')</a>
				</div>
			</div>
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
			<div class="search">
				<div class="prefix">@include('svg.magnifying-glass')</div>
				<input
					type="text"
					name="search"
					placeholder="Поиск"
					v-model="$store.state.searchQuery"
					@focus="$store.commit('searchIsOpen', true)"
				>
			</div>
			<a href="#" class="btn primary">
				@include('svg.user')
				Войти
			</a>
			<a class="btn" @click="$store.commit('cartIsOpen', true)">
				@include('svg.shopping-bag')
				Корзина
			</a>
		</div>
	</div>
</div>