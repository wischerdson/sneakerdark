<template id="template__section_footer">
	<footer id="section_footer">
		<div class="desktop">
			<div class="top">
				<div class="column">
					<a class="brand-logo" href="{{ route('home') }}">@include('svg.brand-logo')</a>
				</div>
				<div class="column">
					<div class="column-title">Навигация</div>
					<ul class="link-list">
						<li class="link-item"><a href="{{ route('home') }}">Главная</a></li>
						<li class="link-item">Отзывы</li>
						<li class="link-item">Частые вопросы</li>
						<li class="link-item">Таблица размеров</li>
						<li class="link-item"><a href="{{ route('legal.refund') }}">Обмен и возврат</a></li>
						<li class="link-item">Информация о доставке</li>
					</ul>
				</div>
				<div class="column">
					<div class="column-title">Контакты</div>
					<ul class="link-list">
						<li class="link-item">8 800 302-00-60</li>
						<li class="link-item">info@sneakerdark.com</li>
						<li class="link-item">Связаться через WhatsApp</li>
						<li class="link-item">Связаться через Telegram</li>
						<li class="link-item">Связаться через ВКонтакте</li>
						<li class="link-item">
							<a @click="$jivo.open">
								<span class="online-dot"></span>Online-чат с менеджером
							</a>
						</li>
					</ul>
				</div>
				<div class="column">
					<div class="column-title">Новостная рассылка</div>
					<div class="form-group">
						<div class="form-control">
							<input placeholder="Введите Ваш e-mail" type="text" name="email">
							<button>Подписаться</button>
						</div>
					</div>
					<ul class="social-media">
						<li><a href="#">@include('svg.footer-logo-instagram')</a></li>
						<li><a href="#">@include('svg.footer-logo-vk')</a></li>
						<li><a href="#">@include('svg.footer-logo-facebook')</a></li>
						<li><a href="#">@include('svg.footer-logo-youtube')</a></li>
						<li><a href="#">@include('svg.footer-logo-twitter')</a></li>
					</ul>
				</div>
			</div>
			<div class="bottom">
				<div class="inner">
					<div class="copyright">© Copyright 2019 Sneakerdark</div>
					<a href="#">Пользовательское соглашение</a>
					<a href="#">Политика конфиденциальности</a>
				</div>
			</div>
		</div>
	</footer>
</template>