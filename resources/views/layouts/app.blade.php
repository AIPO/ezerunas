<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script>
        window.App = {!!
            json_encode([
                'csrf-token' => csrf_token(),
                'signedIn' => Auth::check(),
                'user' => Auth::user(),
            ]) !!}
    </script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body style="padding-bottom: 100px;">
    <div id="app">
        @include('layouts.nav')
        <main class="py-4">
            @yield('content')
        </main>
        <flash message="{{session('flash')}}"></flash>
    </div>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</body>

</html>
