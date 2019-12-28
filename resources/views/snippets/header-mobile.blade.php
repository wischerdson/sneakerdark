<div class="mobile">
	<div>
		<div class="burger square-button" @click="sidebarIsOpen = true">
			<div class="icon">
				<div class="h-line"></div>
				<div class="h-line"></div>
			</div>
		</div>
		<div class="search square-button" @click="openSearch">
			<div class="icon">
				@include('svg.magnifying-glass')
			</div>
		</div>
	</div>
	<div>
		<a class="brand-name" href="{{ route('home') }}">
			@include('svg.brand-name')
		</a>
	</div>
	<div>
		<div class="account square-button">
			<div class="icon">
				@include('svg.user')
			</div>
		</div>
		<div class="shopping-cart square-button">
			<div class="icon">
				@include('svg.shopping-cart')
			</div>
		</div>
	</div>
</div>

<transition name="sidebar-fade">
	<div class="sidebar-wrapper" v-show="sidebarIsOpen">
		<div class="overlay" @click="sidebarIsOpen = false">@include('svg.cross')</div>
		<div class="sidebar grey darken-4">
			<div class="top">
				<div class="main-info">
					<div class="logo">
						<a href="{{ route('home') }}">@include('svg.brand-logo')</a>
					</div>
					<div class="text">
						<div class="call">
							<div class="label">Звонок бесплатный</div>
							<a href="tel:89101127174" class="phone-number">8 910 112-71-74</a>
						</div>
						<div class="description">Магазин одежды, обуви<br>и аксессуаров</div>
					</div>
				</div>
				<div class="search">
					<div class="prefix">@include('svg.magnifying-glass')</div>
					<input
						placeholder="Введите Ваш запрос"
						type="text"
						v-model="$store.state.searchQuery"
						@focus="openSearch"
					>
				</div>
			</div>
			<div ref="wrapper" class="middle" id="sidebar_wrapper">
				<div ref="root" class="link-list" id="sidebar_root">
					<li class="link-item"><a href="{{ route('home') }}">Главная</a></li>
					<li class="link-item"><a href="#">Бренды</a></li>
					<li class="link-item">
						<a @click="changeList('men', 'root', 'hidden-left')">Мужское @include('svg.keyboard-arrow-right')</a>
					</li>
					<li class="link-item">
						<a @click="changeList('women', 'root', 'hidden-left')">Женское @include('svg.keyboard-arrow-right')</a>
					</li>
					<li class="link-item"><a href="#">Аксессуары</a></li>
					<li class="link-item"><a href="#">Отзывы</a></li>
					<li class="link-item"><a href="#"><span class="online-dot"></span>Online-чат с менеджером</a></li>
				</div>
				<div ref="women" class="link-list hidden-right" style="z-index: 2;">
					<li class="link-item back">
						<a @click="changeList('root', 'women', 'hidden-right')">
							@include('svg.keyboard-arrow-left')
							<span>Женское</span>
						</a>
					</li>
					<li class="link-item"><a href="#">Обувь</a></li>
					<li class="link-item"><a href="#">Куртки</a></li>
					<li class="link-item"><a href="#">Футболки</a></li>
					<li class="link-item"><a href="#">Свитшоты</a></li>
					<li class="link-item"><a href="#">Худи</a></li>
					<li class="link-item"><a href="#">Штаны</a></li>
					<li class="link-item"><a href="#">Спортивные костюмы</a></li>
					<li class="link-item view-all-products-link"><a href="#">Посмотреть все товары</a></li>
				</div>
				<div ref="men" class="link-list hidden-right" style="z-index: 2;">
					<li class="link-item back">
						<a @click="changeList('root', 'men', 'hidden-right')">
							@include('svg.keyboard-arrow-left')
							<span>Мужское</span>
						</a>
					</li>
					<li class="link-item"><a href="#">Обувь</a></li>
					<li class="link-item"><a href="#">Футболки</a></li>
					<li class="link-item"><a href="#">Штаны</a></li>
					<li class="link-item"><a href="#">Спортивные костюмы</a></li>
					<li class="link-item view-all-products-link"><a href="#">Посмотреть все товары</a></li>
				</div>
			</div>
			<div class="bottom">
				<div class="buttons">
					<a href="#" class="btn waves-effect waves-light entrance primary">
						@include('svg.user')
						Войти
					</a>
					<a class="waves-effect btn shopping-cart">
						@include('svg.shopping-cart')
						Корзина
					</a>
				</div>
				<div class="manager-contacts">
					<div class="label">Связь с менеджером</div>
					<div class="variants">
						<a href="#">{{-- @include('svg.contact-method-1') --}}</a>
						<a href="#">{{-- @include('svg.contact-method-2') --}}</a>
						<a href="#">{{-- @include('svg.contact-method-3') --}}</a>
						<a href="#">{{-- @include('svg.contact-method-4') --}}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</transition>