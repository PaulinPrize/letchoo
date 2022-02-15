<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <title>{{ config('app.name', 'Le Tchoo') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

        <!-- Styles -->
        <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">

    </head>
    <body>
        <header id="page-top">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
                <div class="container">
                    <a class="navbar-brand js-scroll-trigger" href="/" title="">
                        <img src="{{asset('public/img/logo/1.png')}}" style="height:85px">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                            
                            <li class="nav-item">
                                <a class="nav-link active js-scroll-trigger" href="/">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="" title="">Qui sommes-nous ?</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="" title="">Devenir hôte</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="" title="">Contact</a>
                            </li>
                            
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            @if (Route::has('login'))
                                <div class="">
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="text-muted text-decoration-none">Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="text-muted text-decoration-none">Log in</a>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="ml-4 text-muted text-decoration-none">Register</a>
                                        @endif
                                    @endif
                                </div>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
            
        </header>

        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>    
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; 2021 Le tchoo, tous droits réservés. 
                </p>
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="{{ asset('public/js/app.js') }}" defer></script>
        @yield('scripts')        
    </body>
</html>