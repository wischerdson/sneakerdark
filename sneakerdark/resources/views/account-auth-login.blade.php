@extends('layouts.default')


@section('content')

<section id="login">
	<div class="block login-block">
		<div class="top">
			<h2>Вход</h2>
			<p class="explanation">Войдите, используя свой e-mail и пароль</p>
		</div>
		<form>
			<div class="row">
				<label for="login_email">E-mail</label>
				<div class="form-group">
					<input type="email" id="login_email" name="email" class="browser-default" required>
					@include('icons.envelope')
				</div>
			</div>
			<div class="row">
				<label for="login_password">Пароль</label>
				<div class="form-group">
					<input type="password" id="login_password" name="password" class="browser-default" required>
					@include('icons.lock')
				</div>
			</div>
			<div class="row">
				<button class="login-btn btn" type="submit">Войти</button>
				<a href="{{ route('account.register') }}" class="register-btn btn btn-secondary">Регистрация</a>
			</div>
			<div class="row forgot-password-row"><a href="#">Забыли пароль?</a></div>
		</form>
		<div class="bottom">
			<p class="explanation">Войдите, используя свой аккаунт<br>в соц. сетях</p>
			<div class="social-media">
				<a href="{{ route('account.login.vk') }}" class="btn vk waves-effect waves-light">@include('icons.logo-vk')</a>
				<a class="btn odnoklassniki waves-effect">@include('icons.logo-odnoklassniki')</a>
			</div>
		</div>
	</div>

</section>


@endsection