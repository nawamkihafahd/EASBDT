<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background: url({{asset('static/website/img/background.jpg')}}) no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  -o-background-size: cover;">
<nav class="navbar navbar-expand-sm bg-light navbar-light">
<a class="navbar-brand" href="{{route('landing.index')}}">
    <img src="{{asset('static/website/img/logo.jpg')}}" alt="Logo" style="width:70px;">
  </a>
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="{{route('landing.index')}}">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('landing.about')}}">About</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('landing.tatacara')}}">Tata Cara</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('landing.daftar')}}">Pendaftaran</a>
    </li>
  </ul>
</nav>
	@yield('content')
	@include('website.partials.scripts')
</body>
</html>