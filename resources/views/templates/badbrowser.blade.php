<!DOCTYPE html>
<html lang="ru">
<head>
	<!-- saved from url=(0014)about:internet -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no, maximum-scale=1.0">
	<meta name="HandheldFriendly" content="True">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="cleartype" content="on">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="imagetoolbar" content="no">
	<meta http-equiv="msthemecompatible" content="no">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<meta name="robots" content="noindex">

	<title>Неподдерживаемый браузер</title>
	<meta name="copyright" content="Sneakerdark">
	
	<link rel="icon" href="{{ asset('/favicon/icon.svg') }}" sizes="any" type="image/svg+xml"> 
	<link rel="icon" sizes="48x48" href="{{ asset('/favicon/icon-48.png') }}">
	<link rel="icon" sizes="96x96" href="{{ asset('/favicon/icon-96.png') }}">
	<link rel="icon" sizes="144x144" href="{{ asset('/favicon/icon-144.png') }}">
	<link rel="icon" sizes="192x192" href="{{ asset('/favicon/icon-192.png') }}">
	<link rel="icon" sizes="256x256" href="{{ asset('/favicon/icon-256.png') }}">
	<link rel="icon" sizes="384x384" href="{{ asset('/favicon/icon-384.png') }}">
	<link rel="icon" sizes="512x512" href="{{ asset('/favicon/icon-512.png') }}">
	<link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/favicon/apple-touch-icon-57.png') }}">
	<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/favicon/apple-touch-icon-60.png') }}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/favicon/apple-touch-icon-72.png') }}">
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/favicon/apple-touch-icon-76.png') }}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/favicon/apple-touch-icon-114.png') }}">
	<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/favicon/apple-touch-icon-120.png') }}">
	<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/favicon/apple-touch-icon-152.png') }}">
	<link rel="apple-touch-icon" sizes="167x167" href="{{ asset('/favicon/apple-touch-icon-167.png') }}">
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/favicon/apple-touch-icon-180.png') }}">
	<link rel="mask-icon" href="{{ asset('/favicon/safari-pinned-tab.svg" color="#ffffff') }}">
	<meta name="msapplication-TileColor" content="#101011">
	<meta name="msapplication-TileImage" content="{{ asset('/favicon/ms-tile-144.png') }}">
	<link rel="manifest" href="{{ asset('/favicon/site.webmanifest') }}">

	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body>
	<main>
		<div id="template_badbrowser">
			<div class="brand-logo">@include('svg.brand-logo')</div>
			<div class="text">
				<h2>Похоже, Ваш браузер не поддерживается</h2>
				<p>Рекомендуем скачать и установить последнюю версию одного из следующих браузеров:</p>
			</div>
			<div class="good-browsers">
				<a target="_blank" href="https://www.mozilla.org" class="firefox">
					<div class="image" style="background-image: url({{ asset('/image/firefox.png') }})"></div>
					<div class="tag">Mozilla Firefox</div>
				</a>
				<a target="_blank" href="https://www.google.com/chrome/" class="chrome">
					<div class="image" style="background-image: url({{ asset('/image/chrome.png') }})"></div>
					<div class="tag">Google Chrome</div>
				</a>
				<a target="_blank" href="https://www.opera.com/" class="opera">
					<div class="image" style="background-image: url({{ asset('/image/opera.png') }})"></div>
					<div class="tag">Opera</div>
				</a>
			</div>
		</div>
	</main>

	<script type="text/javascript">
		location.href = '{{ route('home') }}'
	</script>
</body>
</html>