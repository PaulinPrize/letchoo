<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- Fonts -->		
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
		<link href="https://fonts.googleapis.com/css?family=Quicksand:400,600,700&display=swap" rel="stylesheet">

		<link rel="stylesheet" href="{{asset('public/css/owl.carousel.min.css')}}">
		<link rel="stylesheet" href="{{asset('public/fonts/icomoon/style.css')}}">
        <link rel="stylesheet" href="{{ asset('public/css/iziToast.min.css') }}">

        <!-- Styles -->
        <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
		<link href="{{ asset('public/css/style.css') }}" rel="stylesheet"> 
		@yield('styles')

		<title>{{ config('app.name', 'Le Tchoo') }}</title>			

    </head>
    <body>
        <!-- Menu mobile -->
		<div class="site-mobile-menu site-navbar-target">
			<div class="site-mobile-menu-header">
				<div class="site-mobile-menu-close mt-3">
					<span class="icon-close2 js-menu-toggle"></span>
				</div>
			</div>
			<div class="site-mobile-menu-body"></div>
		</div>        
		<!-- En-tête -->
		<header class="site-navbar mt-3">
			<div class="container-fluid">
				<div class="row align-items-center">
					<div class="site-logo col-6">
						<!--<a href="index.html">Brand</a>-->
						<a href="{{route('home')}}">
							<img src="{{asset('public/img/logo/1.png')}}" style="height:90px">
						</a>
					</div>
					
					<nav class="mx-auto site-navigation">
						<ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
							<li class="nav-item">
								<a href="{{route('home')}}" class="nav-link {{ Request::is('home*') ? 'active' : '' }}">{{__('messages.Home')}}</a>
							</li>
							<li class="nav-item">
								<a href="{{route('dashboard')}}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">{{__('messages.Who are we')}} ?</a>
							</li>
							<li class="nav-item">
								<a href="{{route('dashboard')}}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">{{__('messages.Become a host')}}</a>
							</li>
							<li class="nav-item">
								<a href="{{route('dashboard')}}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">{{__('messages.Contact')}}</a>
							</li>
							<!--
							<li class="has-children">
								<a href="#"><img src="{{('public/img/flags/GB.png')}}"/> English(UK) <b class="caret"></b></a>
								<ul class="dropdown">
									<li><a href="#"><img src="{{('public/img/flags/FR.png')}}"/> Français</a></li>
								</ul>
							</li>
							-->
							<li class="has-children">
								<a href="#">
									<span class="flag-icon flag-icon-{{Config::get('languages')[App::getLocale()]['flag-icon']}}"></span> {{ Config::get('languages')[App::getLocale()]['display'] }} <b class="caret"></b>
								</a>
								<ul class="dropdown">
									<li>
								    	@foreach (Config::get('languages') as $lang => $language)
								            @if ($lang != App::getLocale())
								                    <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"><span class="flag-icon flag-icon-{{$language['flag-icon']}}"></span> {{$language['display']}}</a>
								            @endif
        								@endforeach
									</li>
								</ul>
							</li>
						</ul>
					</nav>
					
					<div class="right-cta-menu text-right d-flex aligin-items-center col-6">
						@if (Route::has('login'))
						<div class="ml-auto">
							@auth
								<a href="{{ url('/dashboard') }}" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-user"></span>{{__('messages.Dashboard')}}</a>
							@else
								<a href="{{ route('login') }}" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>{{__('messages.Log in')}}</a>
								@if (Route::has('register'))
								<a href="{{ route('register') }}" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-user"></span>{{__('messages.Sign up')}}</a>
								@endif
							@endif
						</div>
						<a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span class="icon-menu h3 m-0 p-0 mt-2"></span></a>
						@endif
					</div>
				</div>
			</div>
		</header>
		@yield('content')
		
		
		<script src="{{ asset('public/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('public/js/popper.min.js') }}"></script>
		<script src="{{ asset('public/js/app.js') }}" ></script>
		<script src="{{ asset('public/js/jquery.sticky.js')}}"></script>
        <script src="{{ asset('public/js/main.js')}}"></script>
		<script src="{{ asset('public/js/bootstrap-autocomplete.min.js') }}"></script>
		
		@yield('scripts')
    </body>
</html>