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

	<title>{{ $title }}</title>
	<meta name="description" content="{{ $description }}">
	<meta name="copyright" content="Sneakerdark (c)">
	<meta http-equiv="Reply-to" content="info@sneakerdark.com">

	<meta property="og:title" content="{{ $title }}">
	<meta property="og:site_name" content="Sneakerdark">
	<meta property="og:url" content="{{ url()->current() }}">
	<meta property="og:description" content="{{ $description }}">
	<meta property="og:image" content="{{ asset('/img/social-media-banner.png') }}">
	
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

	<noscript><meta http-equiv="refresh" content="0; URL=/badbrowser"></noscript>
</head>
<body>
	<div id="app">
		<template id="template__layout">
			<div>
				<section-header></section-header>
				<section-search url="{{ route('search.ajax') }}"></section-search>
				<section-cart></section-cart>
				<main>
					<{{ str_replace('.', '-', $template) }}-page></{{ str_replace('.', '-', $template) }}-page>
				</main>
				<section-footer></section-footer>
			</div>
		</template>
		@include('sections.header')
		@include('sections.cart')
		@include('sections.search')
		@include('templates.'.$template)
		@include('sections.footer')
	</div>
	<script type="text/javascript">
		const _token = '{{ csrf_token() }}'
		const _domain = '{{ Request::root() }}'
	</script>
	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
</html>