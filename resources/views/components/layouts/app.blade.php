<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen antialiased" style="background: linear-gradient(80deg, #EDEDED 100%, #F5F5F5 60%, #EDEDED 100%);">
        {{ $slot }}
        @fluxScripts
    </body>
</html>
