<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Le Tchoo') }}</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

        <!-- <link rel="stylesheet" href="{{ mix('css/dashboard.css') }}"> -->
        <link rel="stylesheet" href="{{ asset('public/css/dashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/custom_dashboard.css') }}">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{asset('public/plugins/fontawesome-free/css/all.min.css')}}">

        
        @livewireStyles

    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed font-sans antialiased">
        <div class="wrapper">
            
            <!-- Navbar -->
            @livewire('navigation-menu')
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-warning  elevation-2" style="background-color: #882E57;">
                <!-- Brand Logo -->
                <a href="{{route('home')}}" class="brand-link text-center p-3">
                    <x-jet-application-mark width="36" class="brand-image img-circle elevation-1" style="opacity: .8" />
                    <img src="{{asset('public/img/logo/3.png')}}" style="height:60px" class="brand-text">
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 mt-5 d-flex">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="image">
                                
                                <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle elevation-1" alt="{{ Auth::user()->name }}">
                                <!--
                                <img src="{{ asset('public/storage/'. Auth::user()->profile_photo_path) }}" class="img-circle elevation-1" alt="{{ Auth::user()->name }}">
                                -->
                            </div>
                        @endif
                        <div class="info">
                            <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2"> 
                        <ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu" data-accordion="false">

                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>{{__('messages.Home')}}</p>
                                </a>
                            </li>

                            @can('list-users')
                            <li class="nav-item">
                                <a href="{{ route('users') }}" class="nav-link {{ Request::is('user*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>{{__('messages.Users')}}</p>
                                </a>
                            </li>
                            @endcan

                            @can('list-roles')
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-lock"></i>
                                    <p>{{__('messages.Roles')}}</p>
                                </a>
                            </li>
                            @endcan

                            @can('list-permissions')
                            <li class="nav-item">
                                <a href="{{ route('permissions.index') }}" class="nav-link {{ Request::is('permissions*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-lock"></i>
                                    <p>{{__('messages.Permissions')}}</p>
                                </a>
                            </li>
                            @endcan

                            @can('list-invitations')
                            <li class="nav-item">
                                <a href="{{ route('invitations') }}" class="nav-link {{ Request::is('invitations*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-glass-cheers"></i>
                                    <p>{{__('messages.All the tables')}}</p>
                                </a>
                            </li>
                            @endcan

                            @can('list-payments')
                            <li class="nav-item">
                                <a href="{{ route('payments') }}" class="nav-link {{ Request::is('payments*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-money-bill-alt"></i>
                                    <p>{{__('messages.All payments')}}</p>
                                </a>
                            </li>
                            @endcan                            

                            @can('my-invitations')
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-glass-cheers"></i>
                                    <p>{{__('messages.Tables')}}</p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('add-invitation')
                                    <li class="nav-item">
                                        <a href="{{ route('invitation.create') }}" class="nav-link">
                                            <i class="fas fa-plus nav-icon"></i>
                                            <p>{{__('messages.Open new table')}}</p>
                                        </a>
                                    </li>
                                    @endcan

                                    @can('find-invitation')
                                    <li class="nav-item">
                                        <a href="{{route('invitations.active')}}" class="nav-link">
                                            <i class="fas fa-search nav-icon"></i>
                                            <p>{{__('messages.Find a table')}}</p>
                                        </a>
                                    </li>
                                    @endcan

                                    @can('my-invitations')
                                    <li class="nav-item">
                                        <a href="{{ route('invitation.my-tables') }}" class="nav-link">
                                            <i class="fas fa-list nav-icon"></i>
                                            <p>{{__('messages.My tables')}}</p>
                                        </a>
                                    </li>
                                    @endcan

                                    @can('my-subscriptions')
                                    <li class="nav-item">
                                        <a href="{{ route('invitation.my-invitations') }}" class="nav-link">
                                            <i class="fas fa-clipboard-check nav-icon"></i>
                                            <p>{{__('messages.My subscriptions')}}</p>
                                        </a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan

                            @can('my-payments')
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-money-bill-alt"></i>
                                    <p>{{__('messages.Payments')}}</p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('my-income')
                                    <li class="nav-item">
                                        <a href="{{ route('payments.my-income') }}" class="nav-link">
                                            <i class="fas fa-wallet nav-icon"></i>
                                            <p>{{__('messages.My income')}}</p>
                                        </a>
                                    </li>
                                    @endcan

                                    @can('my-payments')
                                    <li class="nav-item">
                                        <a href="{{ route('payments.my-payments') }}" class="nav-link">
                                            <i class="far fa-money-bill-alt nav-icon"></i>
                                            <p>{{__('messages.My payments')}}</p>
                                        </a>
                                    </li>
                                    @endcan

                                    <li class="nav-item">
                                        <a href="{{route('payments.choose-receive-payment-method')}}" class="nav-link">
                                            <i class="far fa-plus-square nav-icon"></i>
                                            <p>{{__('messages.Payment method')}}</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @endcan

                            @can('set-bonus')
                                <li class="nav-item">
                                    <a href="{{ route('discounts.show-form') }}" class="nav-link {{ Request::is('discounts*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-award"></i>
                                        <p>{{__('messages.Set bonus')}}</p>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col">
                                <h1>{{ $header }}</h1>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                {{ $slot }}
                            </div>

                            @if (isset($aside))
                                <div class="col-lg-3">
                                    {{ $aside }}
                                </div>
                            @endif
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="m-0 text-center">Copyright &copy; 2022 Le Tchoo, {{__('messages.all rights reserved.')}}</p>
                    </div>
                </div>
                <!--
                <div class="float-right d-none d-sm-block">
                    <b><a href="https://jetstream.laravel.com">Nom Appli</a></b>
                </div>
                <strong>Acte signé et revendiqué par </strong> <a href="http://paulinpriso.online">Paulin Priso</a>
                -->
            </footer>
        </div>

        <script src="{{asset('public/plugins/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('public/plugins/moment/moment.min.js')}}"></script>


        <script src="{{ asset('public/js/app.js') }}" defer></script>
        <script src="{{ asset('public/js/dashboard.js') }}" defer></script>

        @stack('modals')
        @livewireScripts
        @stack('scripts')
        @yield('scripts')
    </body>
</html>
