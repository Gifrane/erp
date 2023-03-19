<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="domain" content="{{ config('app.url') }}">
        <meta name="robots" content="noindex, nofollow">

        @yield('head_meta')

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">

        @vite(['resources/sass/app.sass', 'resources/js/home.js'])
    </head>

    <body style="height: 100vh">
        <div id="app" style="height: 100%">
            @yield('content')
        </div>
    </body>
</html>
