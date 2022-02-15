<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Le tcho') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{asset('public/plugins/fontawesome-free/css/all.min.css')}}">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        
    </head>
    <body class="font-sans antialiased" style="background-color:#882E57">
        {{ $slot }}

    </body>
</html>