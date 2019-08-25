@extends('layouts.default')


@section('content')

<section id="register">
	<h2>Регистрация</h2>
	<p class="explanation">Если Вы уже зарегистрированы, перейдите на страницу <a class="link" href="{{ route('account') }}">входа в систему</a></p>

	<div class="block register-block">
		<form id="accountAuthRegisterForm" @submit.prevent="sendRegisterForm" method="POST" action="{{ route('account.create') }}">
			<div class="row">
				<div class="column">
					<label for="register_name">ФИО</label>
					<div class="form-group">
						<input type="text" id="register_name" name="name" class="browser-default" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="column">
					<label for="register_email">E-mail</label>
					<div class="form-group">
						<input type="email" id="register_email" name="email" class="browser-default" required>
						@include('icons.envelope')
					</div>
				</div>
			</div>
			<div class="row">
				<div class="column">
					<label for="register_phone">Телефон</label>
					<div class="form-group">
						<div class="prefix">+</div>
						<input type="text" id="register_phone" value="7" name="phone" class="browser-default" required>
						@include('icons.handset')
					</div>
				</div>
			</div>
			<div class="row">
				<div class="column">
					<label for="register_password">Пароль</label>
					<div class="form-group">
						<input type="password" id="register_password" name="password" class="browser-default" required>
						@include('icons.lock')
					</div>
				</div>
				<div class="column">
					<label for="register_confirm_password">Подтверждение пароля</label>
					<div class="form-group">
						<input type="password" id="register_confirm_password" name="confirm_password" class="browser-default" required>
						@include('icons.lock')
					</div>
				</div>
			</div>

			<div class="bottom">
				{!! csrf_field() !!}
				<input type="hidden" name="registration_method" value="local">
				<button type="submit" class="btn primary">Продолжить</button>
				<div class="accept">
					<p>Нажимая на кнопку «Продолжить», Вы даете компании «Sneakerdark Store» свое согласие на <a href="#">Обработку<br>персональных данных</a>, также Вы соглашаетесь с <a href="#">Политикой о конфиденциальности</a><br>и принимаете <a href="#">Пользовательское соглашение</a>.</p>
				</div>
			</div>
		</form>
	</div>
</section>

<script type="text/javascript">
	
	new Vue({
		el: '#accountAuthRegisterForm',
		data: {

		},
		methods: {
			sendRegisterForm: function (e) {
				$.ajax({
					url: e.target.action,
					type: e.target.method,
					data: $(e.target).serializeArray(),
					cache: false,
					success: (data) => {
						if (data.status == 'error') {
							alert(data.error_type);
							
							return;
						}
						
						location.href = data;
					},
					error: (error) => {
						M.toast({html: 'An error occurred', classes: 'red lighten-3 black-text'});
						console.log(error);
					}
				});
			}
		}
	});

</script>


@endsection