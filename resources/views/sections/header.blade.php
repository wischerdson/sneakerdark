<header id="site_header" :class="[{'search-results-opened': searchResultsIsOpened}]">
	<div class="desktop">
		<a class="brand" href="{{ route('home') }}">
			<div class="brand-logo">@include('snippets.brand-logo')</div>
			<div class="text">
				<div class="brand-name">@include('snippets.brand-name')</div>
				<div class="description">Магазин одежды, обуви и аксессуаров</div>
			</div>
		</a>
		<div class="contacts">
			<div class="call">
				<div class="label grey-text">Звонок бесплатный</div>
				<a href="tel:88003020060" class="phone-number">8 800 302-00-60</a>
			</div>
			<div class="manager-contacts">
				<div class="label grey-text">Связь с менеджером</div>
				<div class="variants">
					<a href="#">@include('icons.contact-method-1')</a>
					<a href="#">@include('icons.contact-method-2')</a>
					<a href="#">@include('icons.contact-method-3')</a>
					<a href="#">@include('icons.contact-method-4')</a>
				</div>
			</div>
		</div>
	</div>
	<div class="mobile">
		<div class="left">
			<div class="burger" @click="vHeaderNav.mobileMenuIsOpened = true">
				<div class="icon">
					<div class="h-line"></div>
					<div class="h-line"></div>
				</div>
			</div>
			<div class="search">@include('icons.magnifying-glass')</div>
		</div>
		<div class="center">
			<a class="logo" href="{{ route('home') }}">@include('snippets.brand-name')</a>
		</div>
		<div class="right">
			<div class="profile">
				<div class="icon">@include('icons.user')</div>
			</div>
			<div class="shopping-cart"><i class="material-icons">shopping_cart</i></div>
		</div>
	</div>
</header>
<div id="header_nav" v-bind:class="[{'moving': (isMoved || searchResultsIsOpened)}]">
	<div class="desktop">
		<div class="mask"></div>
		<div class="links">
			<div class="link-item"><a class="brand-logo" href="{{ route('home') }}">@include('snippets.brand-logo')</a></div>
			<div class="link-item"><a href="{{ route('home') }}" class="active">Главная</a></div>
			<div class="link-item"><a href="#">Бренды</a></div>
			<div class="link-item"><a href="#">Мужское</a></div>
			<div class="link-item drop-wrapper">
				<a href="#">Женское</a>
				<ul class="dropdown-menu">
					<li><a href="#">Обувь</a></li>
					<li><a href="#">Куртки</a></li>
					<li><a href="#">Футболки</a></li>
					<li><a href="#">Свитшоты</a></li>
					<li><a href="#">Худи</a></li>
					<li><a href="#">Штаны</a></li>
					<li><a href="#">Спортивные костюмы</a></li>
				</ul>
			</div>
			<div class="link-item"><a href="#">Аксессуары</a></div>
			<div class="link-item"><a href="#">Отзывы</a></div>
			<div class="link-item"><a href="#"><span class="online-dot"></span>Online-чат с менеджером</a></div>
		</div>
		<div class="other">
			<div class="search">
				<i class="prefix">@include('icons.magnifying-glass')</i>
				<input v-model="searchQuery" class="browser-default" @focus="vHeader.searchResultsIsOpened = true" placeholder="Поиск" id="search" type="text">
			</div>
			<a class="waves-effect waves-light btn grey darken-4 entrance">
				<i class="material-icons left">@include('icons.user')</i>
				Войти
			</a>
			<a class="waves-effect btn btn-secondary shopping-cart">
				<i class="material-icons left">shopping_cart</i>
				Корзина
			</a>
		</div>
	</div>
	<transition name="fade">
		<div class="mobile" v-show="mobileMenuIsOpened">
			<div class="bg" @click="mobileMenuIsOpened = false"><i class="material-icons">add</i></div>
			<div class="sidebar grey darken-4">
				<div class="top">
					<div class="main-info">
						<div class="logo">
							<a href="{{ route('home') }}">@include('snippets.brand-logo')</a>
						</div>
						<div class="text">
							<div class="call">
								<div class="label">Звонок бесплатный</div>
								<a href="tel:88007752834" class="phone-number">8 (800) 775 28 34</a>
							</div>
							<div class="description">Магазин одежды, обуви<br>и аксессуаров</div>
						</div>
					</div>
					<div class="search">
						<i class="prefix">@include('icons.magnifying-glass')</i>
						<input class="browser-default" placeholder="Введите Ваш запрос" id="search" type="text">
					</div>
				</div>
				<div ref="wrapper" class="middle" id="mobile_header_links_wrapper">
					<div ref="root" class="link-list" id="header_mobile_list_root">
						<li class="link-item"><a href="#">Главная</a></li>
						<li class="link-item"><a href="#">Бренды</a></li>
						<li class="link-item"><a href="#">Мужское</a></li>
						<li class="link-item">
							<a @click="changeList('women', 'root', 'hidden-left')">Женское<i class="material-icons">keyboard_arrow_right</i></a>
						</li>
						<li class="link-item"><a href="#">Аксессуары</a></li>
						<li class="link-item"><a href="#">Отзывы</a></li>
						<li class="link-item"><a href="#"><span class="online-dot"></span>Online-чат с менеджером</a></li>
					</div>
					<div ref="women" class="link-list hidden-right" style="z-index: 2;">
						<li class="link-item back">
							<a @click="changeList('root', 'women', 'hidden-right')">
								<i class="material-icons">keyboard_arrow_left</i>
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
				</div>
				<div class="bottom">
					<div class="buttons">
						<a href="#" class="btn waves-effect waves-light btn entrance">
							<i class="material-icons left">@include('icons.user')</i>
							Войти
						</a>
						<a class="waves-effect btn btn-secondary shopping-cart">
							<i class="material-icons left">shopping_cart</i>
							Корзина
						</a>
					</div>
					<div class="manager-contacts">
						<div class="label">Связь с менеджером</div>
						<div class="variants">
							<a href="#">@include('icons.contact-method-1')</a>
							<a href="#">@include('icons.contact-method-2')</a>
							<a href="#">@include('icons.contact-method-3')</a>
							<a href="#">@include('icons.contact-method-4')</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</transition>

	<transition name="searchResults">
		<div id="search_results" v-show="searchResultsIsOpened">
			<div class="top-bar">
				<div class="content">
					<div class="form-group">
						<i class="prefix">@include('icons.magnifying-glass')</i>
						<input v-model="searchQuery" type="text" class="search-field browser-default" placeholder="Поиск по названию, бренду или артикулу">
					</div>
					<div class="close-btn" @click="vHeader.searchResultsIsOpened = false"><i class="material-icons">add</i></div>
				</div>
			</div>
			<div class="for-whom">
				<div class="content">
					<div class="item">
						<input type="radio" name="forwhom" id="her" value="Женский">
						<label for="her">Для нее</label>
					</div>
					<div class="item">
						<input type="radio" checked name="forwhom" id="him" value="Мужской">
						<label for="him">Для него</label>
					</div>
				</div>
			</div>
		</div>
	</transition>
</div>






<script type="text/javascript">

	let vHeader = new Vue({
		el: '#site_header',
		data: {
			searchResultsIsOpened: true
		},
		watch: {
			searchResultsIsOpened: function (value) {
				vHeaderNav.searchResultsIsOpened = value;
			}
		}
	});

</script>


<script type="text/javascript">

	let searchQueryTimeout;

	let vHeaderNav = new Vue({
		el: '#header_nav',
		data: {
			isMoved: false,
			mobileMenuIsOpened: false,
			searchResultsIsOpened: true,
			searchQuery: ''
		},
		methods: {
			changeList: function (list, outgoingList, whereToGo) {
				$(this.$refs['wrapper']).css('height', $(this.$refs[list]).outerHeight());
				$(this.$refs[list]).removeClass('hidden-left').removeClass('hidden-right');
				$(this.$refs[outgoingList]).addClass(whereToGo);
			}
		},
		created: function () {
			$('#mobile_header_links_wrapper').css('height', $('#header_mobile_list_root').outerHeight());
		},
		watch: {
			searchQuery: function (value) {
				clearTimeout(searchQueryTimeout);
				searchQueryTimeout = setTimeout(() => {
					$.ajax({
						url: '{{ route('search.process_ajax_query') }}',
						type: 'POST',
						data: {
							query: value,
							forwhom: $('[name=forwhom]').val()
						},
						cache: false,
						success: (data) => {
							console.log(data);
						},
						error: (error) => {
							console.log(error);
							// alert('Произошла ошибка');
						}
					});
				}, 700);
			}
		}
	});

	$(document).ready(function () {
		let scrollTop = getWindowScroll();
		vHeaderNav.isMoved = scrollTop >= 82 ? true : false;

		$(window).scroll(function (e) {
			scrollTop = getWindowScroll();
			vHeaderNav.isMoved = scrollTop >= 82 ? true : false;
		});
	});

	let getWindowScroll = function () {
		return window.pageYOffset ? window.pageYOffset : (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop)
	}

</script>