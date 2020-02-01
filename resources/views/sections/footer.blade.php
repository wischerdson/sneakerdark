<template id="template__section_footer">
	<footer id="section_footer">
		<div class="desktop">
			<div class="pictured-items-container container large">
				<a class="pictured-item square" @click="$jivo.open">
					<div>
						<div class="image" style="background-image: url({{ asset('image/footer/footer-card-1.jpg') }})"></div>
						<div class="overlay"></div>
						<div class="icon">@include('svg.footer-card-1')</div>
						<div class="bottom-text">
							Онлайн-поддержка
							@include('svg.arrow-right')
						</div>
					</div>
				</a>
				<a class="pictured-item square" href="#">
					<div>
						<div class="image" style="background-image: url({{ asset('image/footer/footer-card-2.jpg') }})"></div>
						<div class="overlay"></div>
						<div class="icon" style="transform: scale(1.1);">@include('svg.footer-card-2')</div>
						<div class="bottom-text">
							Отзывы
							@include('svg.arrow-right')
						</div>
					</div>
				</a>
				<a class="pictured-item square" href="#">
					<div>
						<div class="image" style="background-image: url({{ asset('image/footer/footer-card-3.jpg') }})"></div>
						<div class="overlay"></div>
						<div class="icon">@include('svg.footer-card-3')</div>
						<div class="bottom-text">
							Каталог
							@include('svg.arrow-right')
						</div>
					</div>
				</a>
				<a class="pictured-item square" href="#">
					<div>
						<div class="image" style="background-image: url({{ asset('image/footer/footer-card-4.jpg') }})"></div>
						<div class="overlay"></div>
						<div class="icon">@include('svg.footer-card-4')</div>
						<div class="bottom-text">
							Новости
							@include('svg.arrow-right')
						</div>
					</div>
				</a>
			</div>
			<div class="top container large">
				<div class="column">
					<div class="column-title">Навигация</div>
					<ul class="link-list">
						<li class="link-item"><a href="{{ route('home') }}" class="link">Главная</a></li>
						<li class="link-item"><a href="{{ route('brands') }}" class="link">Бренды</a></li>
						<li class="link-item"><a href="#" class="link">Отзывы</a></li>
						<li class="link-item"><a href="#" class="link">Частые вопросы</a></li>
						<li class="link-item"><a href="#" class="link">Таблицы размеров</a></li>
						<li class="link-item"><a href="{{ route('legal.refund') }}" class="link">Обмен и возврат</a></li>
					</ul>
				</div>
				<div class="column">
					<div class="column-title">Sneakerdark</div>
					<ul class="link-list">
						<li class="link-item"><a href="#" class="link">О нас</a></li>
						<li class="link-item"><a href="#" class="link">Новости</a></li>
						<li class="link-item"><a href="#" class="link">Адреса магазинов</a></li>
						<li class="link-item"><a href="#" class="link">Связаться с нами</a></li>
					</ul>
				</div>
				<div class="column">
					<div class="column-title">Коллекции</div>
					<ul class="link-list">
						<li class="link-item"><a href="#" class="link">Мужская одежда</a></li>
						<li class="link-item"><a href="#" class="link">Женская одежда</a></li>
						<li class="link-item"><a href="#" class="link">Мужские кроссовки</a></li>
						<li class="link-item"><a href="#" class="link">Женские кроссовки</a></li>
						<li class="link-item"><a href="#" class="link">Аксессуары</a></li>
					</ul>
				</div>
				<div class="column">
					<div class="column-title">Поддержка</div>
					<ul class="link-list">
						<li class="link-item"><a href="#" class="link">Использование cookie</a></li>
						<li class="link-item"><a href="#" class="link">Пользовательское соглашение</a></li>
						<li class="link-item"><a href="#" class="link">Правила и условия использования</a></li>
						<li class="link-item"><a href="#" class="link">Политика конфиденциальности</a></li>
						<li class="link-item"><a @click="$jivo.open" class="link"><span class="online-dot"></span>Онлайн-чат с менеджером</a></li>
					</ul>
				</div>
				<div class="column">
					<div class="column-title">Новостная рассылка</div>
					<form class="subscribe-mailing-list">
						<div class="form-group">
							<input type="text" name="email" placeholder="E-mail" class="form-control">
							<button type="submit" class="btn primary">Подписаться</button>
						</div>
					</form>
					<div class="social-media">
						<a href="#" class="social-media-link">@include('svg.footer-logo-vk')</a>
						<a href="#" class="social-media-link">@include('svg.footer-logo-youtube')</a>
						<a href="#" class="social-media-link">@include('svg.footer-logo-instagram')</a>
						<a href="#" class="social-media-link">@include('svg.footer-logo-facebook')</a>
					</div>
				</div>
			</div>
			<div class="bottom">
				<div class="copyright container large">Copyright © {{ date('Y') }} Sneakerdark</div>
			</div>
		</div>
	</footer>
</template>