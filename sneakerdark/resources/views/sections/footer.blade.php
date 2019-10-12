<footer>
	<div class="desktop">
		<div class="top">
			<div class="inner">
				<div class="columns">
					<a href="{{ route('home') }}" class="column logo">@include('snippets.brand-logo')</a>
					<div class="column info">
						<div class="column-title">Навигация</div>
						<ul class="link-list">
							<li><a href="">Главная</a></li>
							<li><a href="">Отзывы</a></li>
							<li><a href="">Частые вопросы</a></li>
							<li><a href="">Таблица размеров</a></li>
							<li><a href="">Обмен и возврат</a></li>
							<li><a href="">Информация о доставке</a></li>
						</ul>
					</div>
					<div class="column contacts">
						<div class="column-title">Контакты</div>
						<ul class="link-list">
							<li><a href="">8 800 302-00-60</a></li>
							<li><a href="">info@sneakerdark.com</a></li>
							<li><a href="">Связаться через WhatsApp</a></li>
							<li><a href="">Связаться через Telegram</a></li>
							<li><a href="">Связаться через ВКонтакте</a></li>
							<li><a href=""><span class="online-dot"></span>Online-чат с менеджером</a></li>
						</ul>
					</div>
					<div class="column сooperation">
						<a href="#">Сотрудничество</a>
						<a href="#">Дропшипинг</a>
						<a href="#">Оптовые закупки</a>
					</div>
					<div class="column mailing-list-subscribe">
						<div class="column-title">Новостная рассылка</div>
						<form class="form-group">
							<input class="browser-default email-field" required type="email" name="email" placeholder="Введите Ваш E-mail">
							<button class="subscribe-btn waves-effect" type="submit">Подписаться</button>
						</form>
						<ul class="social-media">
							<li><a href="#">@include('icons.footer-logo-instagram')</a></li>
							<li><a href="#">@include('icons.footer-logo-vk')</a></li>
							<li><a href="#">@include('icons.footer-logo-facebook')</a></li>
							<li><a href="#">@include('icons.footer-logo-youtube')</a></li>
							<li><a href="#">@include('icons.footer-logo-twitter')</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="bottom">
			<div class="inner">
				<div class="copyright">&#169; Copyright {{ date('Y') }} Sneakerdark</div>
				<a href="#">Пользовательское соглашение</a>
				<a href="#">Политика конфиденциальности</a>
			</div>
		</div>
	</div>
</footer>