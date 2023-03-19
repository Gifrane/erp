<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="domain" content="{{ config('app.url') }}">
        <meta name="robots" content="noindex, nofollow">

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">

        @vite([ 'resources/sass/app.sass', 'resources/js/app.js' ])

        <title>{{ app()->account->name }}</title>
    </head>

    <body style="height: 100vh;">
        <div id="app" style="height: 100%;">
            <layout avatar="/images/default_picture.jpg" :user='@json(auth()->user())' :agendas='@json($agendas)'
                :langs='@json($langs)' :countries='@json($countries)' :timezones='@json($timezones)'
                :translations='@json($translations)' :hr_collective_agreements='@json($hr_collective_agreements)'
                :hr_contract_types='@json($hr_contract_types)' :user_modules='@json($user_modules)'>
            </layout>
        </div>
    </body>
</html>
<!-- End supervision -->